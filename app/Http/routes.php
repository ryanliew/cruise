<?php
use App\Cruise;
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

Route::get('/', 'Front\FrontController@homepage');
Route::get('home', 'Front\FrontController@homepage');
Route::get('about', 'Front\FrontController@about');
Route::get('cruises', 'Front\FrontController@index');
Route::post('cruises', 'Front\FrontController@search');
Route::get('cruise/{cruise}', 'Front\FrontController@cruise');
Route::post('reservation', 'ReservationController@make');
Route::get('reservation/{reservation}', 'ReservationController@show');
Route::get('reservation/download/{reservation}', 'ReservationController@download');
Route::get('reservation/success/{reservation}', array(
	'as' => 'payment.success',
	'uses' => 'ReservationController@success',
	));
Route::get('reservation/failed/{reservation}', array(
	'as' => 'payment.failed',
	'uses' => 'ReservationController@failed',
	));
Route::post('savepassenger', 'PassengerController@store');
Route::post('makepayment', array(
	'as' => 'payment',
	'uses' => 'PaypalController@postPayment',
	));
Route::get('payment/status', array(
    'as' => 'payment.status',
    'uses' => 'PaypalController@getPaymentStatus',
));

Route::get('/dummy', function(){
	$faker = Faker\Factory::create();
	for($i=0;$i<20;$i++)
	{
		$cruise = array(
			'name' => $faker->name, 
			'description' => $faker->text($maxNbChars = 200), 
			'depart_date' => $faker->randomElement($array = ['2016-1-8', '2016-1-9', '2016-1-10', '2016-1-11', '2016-1-12']),
			'arrive_date' => $faker->randomElement($array = ['2016-1-19', '2016-1-20', '2016-1-21', '2016-1-22', '2016-1-23']),
			'depart_location' => $faker->randomElement($array = ['Singapore', 'Malaysia', 'Maldives', 'Thailand', 'Sri Lanka']),
			'arrive_location' => $faker->randomElement($array = ['Amsterdam', 'Hong Kong', 'China', 'Australia', 'Japan']),
			'price' => $faker->randomFloat($bMaxDecimals = 2, $min = 100, $max = 2000),
			'type' => $faker->randomElement($array = ['Luxury', 'Classic', 'Holiday']),
			'status' => 0,
			);
		$newcruise = Cruise::create($cruise);
		$newcruise->image = "cruise_" . $newcruise->id . ".jpg";
		$newcruise->save();
	}
});

// User Routes
Route::get('user/{user}', 'UserController@show');
Route::post('user/{user}', 'UserController@create');
Route::put('user/{user}', 'UserController@update');
Route::get('user/{user}/reservations', 'UserController@showReservations');

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
	Route::get('promotions', 'PromotionController@getPromotionList');
	Route::get('promotion/new', 'PromotionController@getPromotionForm');
	Route::post('promotion/new', 'PromotionController@postNewPromotion');
	Route::get('promotion/{promotion}', 'PromotionController@getUpdatePromotionForm');
	Route::put('promotion/{promotion}', 'PromotionController@updatePromotion');
	Route::delete('promotion/{promotion}', 'PromotionController@updatePromotion');

	//Admin Amenities Route
	Route::get('amenities', 'AmenityController@getAmenityList');
	Route::get('amenity/new', 'AmenityController@getAmenityForm');
	Route::post('amenity/new', 'AmenityController@postNewAmenity');
	Route::get('amenity/{amenity}', 'AmenityController@getUpdateAmenityForm');
	Route::put('amenity/{amenity}', 'AmenityController@updateAmenity');
	Route::delete('amenity/{amenity}', 'AmenityController@deleteAmenity');

	//Admin Cabin Route
	Route::get('cabins', 'CabinController@getCabinList');
	Route::get('cabin/new', 'CabinController@getCabinForm');
	Route::post('cabin/new', 'CabinController@postNewCabin');
	Route::get('cabin/{cabin}', 'CabinController@getUpdateCabinForm');
	Route::put('cabin/{cabin}', 'CabinController@updateCabin');
	Route::delete('cabin/{cabin}', 'CabinController@deleteCabin');

	//Admin Reservation Route
	Route::get('reservations', 'ReservationController@index');
	Route::get('reservation/{reservation}', 'ReservationController@edit');

	//Admin User Route
	Route::get('users', 'UserController@index');
});


// Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
