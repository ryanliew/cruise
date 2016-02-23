<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;
use Input;
use File;
use DateTime;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users', [
            'users' => $users,
            ]);
    }

    public function showReservations(Request $request, User $user)
    {
        if(Auth::user()->id == $user->id)
        	return view('user.myreservation', [
        		'user' => $user,
        		]);
        else
        	return view('unauthorized');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        if(Auth::user()->id == $user->id)
        	return view('user.profile', [
        		'user' => $user,
        		]);
        else
        	return view('unauthorized');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(Auth::user()->id == $user->id)
        {
	        $this->validate($request, [
	        	'first_name' => 'required|max:50',
	        	'last_name' => 'required|max:50',
	        	'email' => 'required|email|unique:users,email,'. $user->id,
	        	'phone' => 'required',
	        	'country' => 'required',
	        	'address_1' => 'required',
	        	'city' => 'required',
	        	'postal_code' => 'required',
	        	'new_password' => 'same:new_password_again',
	        	'image' => 'image',
	        	]);

	        if(Input::hasFile('image'))
	        {
	            if(File::exists('uploads/' . $user->image))
	                File::delete('uploads/' . $user->image);
	            $file = Input::file('image');
	            $imagename = 'user_' . $user->id . '.' . Input::file('image')->getClientOriginalExtension();
	            $file->move('uploads', $imagename);
	            $user->image = $imagename;
	        }

	        $user->first_name = $request->first_name;
	    	$user->last_name = $request->last_name;
	    	$user->contact_no = $request->phone;
	    	$user->country = $request->country;
	    	$user->address_1 = $request->address_1;
	    	$user->city = $request->city;
	    	$user->postal_code = $request->postal_code;
            $dob = DateTime::createFromFormat('m/d/Y', $request->date_of_birth)->format('Y-m-d');
            $user->date_of_birth = $dob;
	    	if(!empty($request->new_password) && !empty($request->current_password))
	    		$user->password = Hash::make($request->new_password);
	    	if(!empty($request->address_2))
	    		$user->address_2 = $request->address_2;
	    	if($user->email != $request->email)
		    	$user->email = $request->email;

		    $user->save();
		    return view('user.profile', [
        		'user' => $user,
        		])->with('status', 'Profile updated.');
		} else {
        	return view('unauthorized');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
