<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Amenity;
use App\Cruise;
use App\Cabin;
use App\Reservation;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;

class ReservationController extends Controller
{
    //
    /**
     * Create new controller instance.
     *
     */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        $reservations = Reservation::all();
        return view('admin.reservations', [
                'reservations' => $reservations,
            ]);
    }

    public function edit(Reservation $reservation)
    {
        return view('admin.editreservation', [
                'reservation' => $reservation,
            ]);
    }

    public function make(Request $request)
    {
    	$this->validate($request, [
    		'cruise' => 'required|numeric',
    		'cabin' => 'required|numeric',
    		]);

        /*
         * Start creating reservation
         *
         */

    	$cruise = Cruise::find($request->cruise);
    	$cabin = Cabin::find($request->cabin);

    	$price = $cruise->price + $cabin->price;

        if(!empty($request->amenity))
        {
            $amenities = [];
            foreach($request->amenity as $amenity):
                $ameni = Amenity::find($amenity);
                array_push($amenities, $ameni);
                $price += ($ameni->price * $cabin->size);
            endforeach;
        }

        $reservation = Reservation::create([
            'cruise_id' => $cruise->id,
            'cabin_id' => $cabin->id,
            'status' => 0,
            'price' => $price,
            'user_id' => Auth::user()->id,
            ]);

        if(!empty($request->amenity))
            $reservation->amenities()->attach( $ameni->id );

    	return view('user.reservation', [
    			'cruise' => $cruise,
    			'cabin' => $cabin,
    			'amenities' => $amenities,
    			'reservation' => $reservation,
    		]);
    }

    public function show(Request $request, Reservation $reservation)
    {
        $cruise = Cruise::find($reservation->cruise_id);
        $cabin = Cabin::find($reservation->cabin_id);
        $amenities = $reservation->amenities()->get();

        return view('user.reservation', [
                'cruise' => $cruise,
                'cabin' => $cabin,
                'amenities' => $amenities,
                'reservation' => $reservation,
            ]);

    }

    public function failed(Request $request, Reservation $reservation)
    {
        return view('user.reservation', [
            'cruise' => $cruise,
            'cabin' => $cabin,
            'amenities' => $reservation->amenities()->get(),
            'reservation' => $reservation,
            ])->with('error', 'Payment failed!');
    }
    
    public function success(Request $request, Reservation $reservation)
    {
        //change reservation status to complete
        $payment_id = Session::get('paypal_payment_id');
        $reservation->status = 1;
        $reservation->payment_id = $payment_id;
        $cruise = Cruise::find($reservation->cruise_id);
        $cabin = Cabin::find($reservation->cabin_id);
        
        //deduct cabin number in the cruise
        DB::table('cruises_cabins')
            ->where('cruise_id', $reservation->cruise_id)
            ->where('cabin_id', $reservation->cabin_id)
            ->increment('cabin_booked');

        $reservation->save();
        Session::forget('paypal_payment_id');
        $full = 0;
        foreach($cruise->cabins as $cabin)
        {
            if($cabin->pivot->cabin_number == $cabin->pivot->cabin_booked)
                $full++;
        }

        if($full == Cabin::all()->count())
        {
            $cruise->status = 1;
            $cruise->save();
        }
        return view('user.reservation', [
            'cruise' => $cruise,
            'cabin' => $cabin,
            'amenities' => $reservation->amenities()->get(),
            'reservation' => $reservation,
            ])->with('status', 'Payment succcess!');
    }

    public function download(Request $request, Reservation $reservation)
    {
        $html = '<head><meta http-equiv="content-type" content="text/html; charset=utf-8"><style>.text-center{text-align:center;}</style></head><body><div class="text-center"><h3>Carnival Corporation</h3></div><hr><div style="border:1px solid #666;"><div style="text-align:left;padding:15px;"><b>Reservation ID: #</b>' . $reservation->id .'<br><b>Cruise Name: </b>' . $reservation->cruise->name . '<br><b>Depart: </b>' . $reservation->cruise->depart_location . '<br><b>Arrive: </b>' . $reservation->cruise->arrive_location . '<br><b>Check-in: </b>' . $reservation->cruise->depart_date . '<br><b>Check-out: </b>' . $reservation->cruise->arrive_date . '<br><b>Stay: </b>' . $reservation->cruise->duration() . ' days, ' . $reservation->cabin->name . ', Max ' . $reservation->cabin->size . ' Adult(s)<br><b>Cruise Type: </b>' . $reservation->cruise->type . ' Cruise</div></div></body>';
        echo $html;
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($html);
        return $pdf->setPaper('a4')->setOrientation('potrait')->download('reservation.pdf');
    }

}
