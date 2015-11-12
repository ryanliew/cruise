<?php

namespace App\Http\Controllers;
use DB;
use \Input as Input;
use App\Cruise;
use App\Cabin;
use Illuminate\Http\Request;
use DateTime;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CruiseController extends Controller
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

    public function getCruiseList()
    {
    	$cruises = Cruise::all();
        $cabins = Cabin::all();
        return view('admin.cruises', [
            'cruises' => $cruises,
            'cabins' => $cabins,
            ]);
    }

    public function getCruiseForm()
    {
        $cabins = Cabin::all();
    	return view('admin.cruise', [
            'cabins' => $cabins,
            ]);
    }

    public function getUpdateCruiseForm(Request $request, Cruise $cruise)
    {
    	$cabins = Cabin::all(); 
        $withcabins = $cruise->cabins;
        $data = [];
        foreach($withcabins as $withcabin)
        {
            $data[$withcabin->pivot->cabin_id] = $withcabin->pivot->cabin_number;
        }
        $data = array(
    		'cruise' => $cruise,
            'cabins' => $cabins,
            'withcabin' => $data,
    		);
    	return view('admin.editcruise', $data);
    }

    public function deleteCruise(Request $request, Cruise $cruise)
    {

        $cruise->active = 2;
        $cruise->save();

        return redirect('admin/cruises')->with('status', 'Cruise canceled!');
    }
    public function postNewCruise(Request $request)
    {
    	//validate input
        $this->validate($request, [
    		'name' => 'required|max:50',
    		'price' => 'required|numeric',
    		'depart_location' => 'required',
    		'arrive_location' => 'required',
    		'route_date' => 'required|max:23',
    		]);

        //process dates
    	$dates = explode(" - ", $request->route_date);
    	$depart = DateTime::createFromFormat('m/d/Y', $dates[0])->format('Y-m-d');
    	$arrive = DateTime::createFromFormat('m/d/Y', $dates[1])->format('Y-m-d');
    	
        //create a new cruise
        $cruise = Cruise::create([
    		'name' => $request->name,
    		'price' => $request->price,
    		'depart_location' => $request->depart_location,
    		'arrive_location' => $request->arrive_location,
    		'description' => $request->description,
    		'type' => $request->type,
    		'depart_date' => $depart,
    		'arrive_date' => $arrive,
    		]);

        if(Input::hasFile('image'))
        {
            $file = Input::file('image');
            $imagename = 'cruise_' . $cruise->id . '.' . Input::file('image')->getClientOriginalExtension();
            $file->move('uploads', $imagename);
            $cruise->image = $imagename;
        }

        foreach($request->get('cabins') as $key => $val)
        {
             //use save method
            $cabinnum = Input::get('cabins.' . $key);
            if($cabinnum != 0 || !empty($cabinnum))
                $cruise->cabins()->attach([$key => ['cabin_number' => $cabinnum]]);
        }

        //redirect to cruises page
    	return redirect('/admin/cruise/' . $cruise->id)->with('status', 'Cruise created successfully!');
    }

    public function updateCruise(Request $request, Cruise $cruise)
    {
         $this->validate($request, [
            'name' => 'required|max:50',
            'price' => 'required|numeric',
            'depart_location' => 'required',
            'arrive_location' => 'required',
            'route_date' => 'required|max:23',
            ]);
        $dates = explode(" - ", $request->route_date);
        $depart = DateTime::createFromFormat('m/d/Y', $dates[0])->format('Y-m-d');
        $arrive = DateTime::createFromFormat('m/d/Y', $dates[1])->format('Y-m-d');
        $cruise->name = $request->name;
        $cruise->price = $request->price;
        $cruise->depart_location = $request->depart_location;
        $cruise->arrive_location = $request->arrive_location;
        $cruise->description = $request->description;
        $cruise->type = $request->type;
        $cruise->depart_date = $depart;
        $cruise->arrive_date = $arrive;

        if(Input::hasFile('image'))
        {
            if(File::exists('uploads/' . $cruise->image))
                File::delete('uploads/' . $cruise->image);
            $file = Input::file('image');
            $imagename = 'cruise_' . $cruise->id . '.' . Input::file('image')->getClientOriginalExtension();
            $file->move('uploads', $imagename);
            $cruise->image = $imagename;
        }
        $cabins = Cabin::all();
        $data = [];
        foreach($cabins as $cabin)
        {
            $cabinnum = Input::get('cabins.' . $cabin->id); 
            if(!empty($cabinnum) || $cabinnum != 0)
            {
                $data[$cabin->id]['cabin_number'] = $cabinnum;
            }
        }
        $cruise->cabins()->sync($data);

        $cruise->save();

        return redirect('/admin/cruise/' . $cruise->id)->with('status', 'Cruise updated!');
    }
}
