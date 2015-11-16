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


    public function make(Request $request)
    {
    	$this->validate($request, [
    		'cruise' => 'required|numeric',
    		'cabin' => 'required|numeric',
    		]);

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

    public function success(Request $request, Reservation $reservation)
    {
        //change reservation status to complete
        $payment_id = Session::get('paypal_payment_id');
        Session::forget('paypal_payment_id');
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

        return view('user.reservation', [
            'cruise' => $cruise,
            'cabin' => $cabin,
            'amenities' => $reservation->amenities()->get(),
            'reservation' => $reservation,
            ])->with('status', 'Payment succcess!');
    }
}
