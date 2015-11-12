<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Amenity;
use \Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AmenityController extends Controller
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

    public function getAmenityList()
    {
    	$amenities = Amenity::all();
    	return view('admin.amenities', ['amenities' => $amenities]);
    }

    public function getAmenityForm()
    {
    	return view('admin.amenity');
    }

    public function getUpdateAmenityForm(Request $request, Amenity $amenity)
    {
    	return view('admin.editamenity', ['amenity' => $amenity]);
    }

    public function deleteAmenity(Request $request, Amenity $amenity)
    {
    	$amenity->delete();
    	return redirect('admin/amenities')->with('status', 'Amenity deleted!');
    }

    public function updateAmenity(Request $request, Amenity $amenity)
    {
    	//validate input
    	$this->validate($request, [
    		'name' => 'required|max:50',
    		'price' => 'required|numeric|min:0',
    		'amenity_image' => 'image',
    		]);

    	$amenity->name = $request->name;
    	$amenity->price = $request->price;
    	$amenity->description = $request->description;

    	if(Input::hasFile('image'))
    	{
    		if(File::exists('uploads/' . $amenity->image))
    			File::delete('uploads/' . $amenity->image);
    		$file = Input::file('image');
    		$imgname = 'amenity_' . $amenity->id . '.' . Input::file('image')->getClientOriginalExtension();
    		$file->move('uploads', $imagename);
    		$amenity->image = $imagename;
    	}

    	$amenity->save();

    	return redirect('/admin/amenity/' . $amenity->id)->with('status', 'Updated successfully!');
    }

    public function postNewAmenity(Request $request)
    {
    	//validate input
    	$this->validate($request, [
    		'name' => 'required|max:50',
    		'price' => 'required|numeric|min:0',
    		'image' => 'image',
    		]);

    	//create a new amenity
    	$amenity = Amenity::create([
			'name' => $request->name,
			'price' => $request->price,
			'description' => $request->description,
    		]);

    	//upload image
    	if(Input::hasFile('image'))
    	{
    		$file = Input::file('image');
    		$imagename = 'amenity_' . $amenity->id . '.' . Input::file('image')->getClientOriginalExtension();
    		$file->move('uploads', $imagename);
    		$amenity->image = $imagename;
    	}

    	$amenity->save();

    	return redirect('/admin/amenity/' . $amenity->id)->with('status', 'Amenity created successfully!');
    }
}
