<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use DB;
use App\Cruise;
use App\Amenity;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function homepage()
    {
        $lastcruises = Cruise::active()->lastminute()->take(8)->get();
        $locations = Cruise::active()->groupBy('arrive_location')->get();
        $depart = Cruise::active()->groupBy('depart_location')->get();
        $cruises = Cruise::active()->get();
        return view('user/home', [
            'departs' => $depart,
            'lastmincruises' => $lastcruises,
            'locations' => $locations,
            'cruises' => $cruises,
            ]);
    }

    public function about()
    {
        return view('user/about');
    }

    public function index()
    {
        $locations = Cruise::active()->groupBy('arrive_location')->get();
        $depart = Cruise::active()->groupBy('depart_location')->get();
        $cruises = Cruise::active()->paginate(10);
        return view('user/cruises', [
            'departs' => $depart,
            'locations' => $locations,
            'cruises' => $cruises,
            ]);
    }

    public function search(Request $request)
    {
        $locations = Cruise::active()->groupBy('arrive_location')->get();
        $depart = Cruise::active()->groupBy('depart_location')->get();
        $whereclause = '';
        if(!empty($request->arrive))
        {
            $whereclause .= 'arrive_location = "';
            $whereclause .= $request->arrive;
            $whereclause .= '"';
        }

        if(!empty($request->depart))
        {
            if(!empty($request->arrive))
                $whereclause .= ' or ';
            $whereclause .= 'depart_location = "';
            $whereclause .= $request->depart;
            $whereclause .= '"';
        }

        if(!empty($request->month))
        {
            if(!empty($request->depart) || !empty($request->arrive))
                $whereclause .= ' or ';
            $whereclause .= 'MONTH(depart_date) =';
            $whereclause .= $request->month;
        }

        if(!empty($request->month) || !empty($request->depart) || !empty($request->arrive))
            $cruises = Cruise::active()->whereRaw($whereclause)->paginate(10);
        else 
            $cruises = Cruise::active()->paginate(10);

        return view('user/cruises', [
            'departs' => $depart,
            'locations' => $locations,
            'cruises' => $cruises,
            ]);
    }

    public function cruise(Request $request, Cruise $cruise)
    {
        $amenities = Amenity::all();
        return view('user/cruise', [
            'amenities' => $amenities,
            'cruise' => $cruise,
            ]);
    }
}
