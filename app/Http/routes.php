<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// User Routes
Route::get('user/{id}', 'User\UserController@editProfile');
Route::post('user/{id}', 'User\UserController@postProfile');

//Cruise Routes
Route::get('cruises', 'Cruise\CruiseController@index');
Route::get('cruise/{id}', 'Cruise\CruiseController@getCruise');

//Promotion Routes

//Amenities Routes

//Cabins Routes

//Reservations Routes

//All Admin Routes
Route::group(['prefix' => 'admin'], function()
{
	//Admin Dashboard Route
	Route::get('/', function(){
		return view('admin.dashboard');
	});
	//Admin Cruise Route
	Route::get('cruises', 'CruiseController@getCruiseList');
	Route::get('cruise/new', 'CruiseController@getCruiseForm');
	Route::post('cruise/new', 'CruiseController@postNewCruise');
	Route::get('cruise/{cruise}', 'CruiseController@getUpdateCruiseForm');
	Route::put('cruise/{cruise}', 'CruiseController@updateCruise');
	Route::delete('cruise/{cruise}', 'CruiseController@deleteCruise');


	//Admin Promotion Route
	Route::group(['namespace' => 'Promotion'], function()
	{
		Route::get('promotions', 'PromotionController@getPromotionList');
		Route::get('promotion/new', 'PromotionController@getPromotionForm');
		Route::post('promotion/new', 'PromotionController@postNewPromotion');
		Route::get('promotion/{id}', 'PromotionController@getUpdatePromotionForm');
		Route::put('promotion/{id}', 'PromotionController@updatePromotion');
		Route::delete('promotion/{id}', 'PromotionController@updatePromotion');
	});

	//Admin Amenities Route
	Route::group(['namespace' => 'Amenity'], function()
	{
		Route::get('amenities', 'AmenityController@getAmenityList');
		Route::get('amenity/new', 'AmenityController@getAmenityForm');
		Route::post('amenity/new', 'AmenityController@postNewAmenity');
		Route::get('amenity/{id}', 'AmenityController@getUpdateAmenityForm');
		Route::put('amenity/{id}', 'AmenityController@updateAmenity');
		Route::delete('amenity/{id}', 'AmenityController@deleteAmenity');
	});

	//Admin Cabin Route
	Route::group(['namespace' => 'Cabin'], function()
	{
		Route::get('cabins', 'CabinController@getCabinList');
		Route::get('cabin/new', 'CabinController@getCabinForm');
		Route::post('cabin/new', 'CabinController@postNewCabin');
		Route::get('cabin/{id}', 'CabinController@getUpdateCabinForm');
		Route::put('cabin/{id}', 'CabinController@updateCabin');
		Route::delete('cabin/{id}', 'CabinController@deleteCabin');
	});

	//Admin Reservation Route
	Route::group(['namespace' => 'Reservation'], function()
	{
		Route::get('reservations', 'ReservationController@getCruiseList');
		Route::get('reservation/{id}', 'ReservationController@getUpdateReservationForm');
		Route::put('reservation/{id}', 'ReservationController@updateReservation');
		Route::delete('reservation/{id}', 'ReservationController@deleteReservation');
	});
});


// Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
