<?php

namespace App\Http\Controllers;
use App\Cabin;
use Illuminate\Http\Request;
use \Input as Input;
use \File as File;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CabinController extends Controller
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

    public function getCabinList()
    {
    	$cabins = Cabin::all();
    	return view('admin.cabins', ['cabins' => $cabins]);
    }

    public function getCabinForm()
    {
    	return view('admin.cabin');
    }

    public function getUpdateCabinForm(Request $request, Cabin $cabin)
    {
    	return view('admin.editcabin', ['cabin' => $cabin]);
    }

    public function deleteCabin(Request $request, Cabin $cabin)
    {
    	$cabin->delete();

    	return redirect('admin/cabins')->with('status', 'Cabin deleted!');
    }

    public function updateCabin(Request $request, Cabin $cabin)
    {
    	//validate input
    	$this->validate($request, [
    		'name' => 'required|max:50',
    		'price' => 'required|numeric|min:0',
    		'size' => 'required|numeric|min:1',
    		'cabin_image' => 'image',
    		]);

    	$cabin->name = $request->name;
    	$cabin->price = $request->price;
    	$cabin->description = $request->description;
    	$cabin->size = $request->size;

    	if(Input::hasFile('cabin_image'))
    	{
    		if(File::exists('uploads/' . $cabin->image))
    			File::delete('uploads/' . $cabin->image);
    		$file = Input::file('cabin_image');
    		$imagename = 'cabin_' . $cabin->id . '.' . Input::file('cabin_image')->getClientOriginalExtension();
    		$file->move('uploads', $imagename);
    		$cabin->image = $imagename;
    	}

    	$cabin->save();

    	return redirect('/admin/cabin/' . $cabin->id)->with('status', 'Cabin updated!');
    }

    public function postNewCabin(Request $request)
    {
    	//validate input
    	$this->validate($request, [
    		'name' => 'required|max:50',
    		'price' => 'required|numeric|min:0',
    		'size' => 'required|numeric|min:1',
    		'cabin_image' => 'image',
    		]);

    	//create a new cabin
    	$cabin = Cabin::create([
    		'name' => $request->name,
    		'price' => $request->price,
    		'description' => $request->description,
    		'size' => $request->size,
    		]);

    	//upload image
    	if(Input::hasFile('cabin_image'))
    	{
    		$file = Input::file('cabin_image');
    		$imagename = 'cabin_' . $cabin->id . '.' . Input::file('cabin_image')->getClientOriginalExtension();
    		$file->move('uploads', $imagename);
    		$cabin->image = $imagename;
    	}

    	$cabin->save();

    	//Redirect to cabins page
    	return redirect('/admin/cabin/' . $cabin->id)->with('status', 'Cabin created successfully!');
    }
}
