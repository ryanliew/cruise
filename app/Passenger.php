<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    //
    protected $fillable = ['identification', 'name', 'gender', 'cruise_id', 'nationality', 'contact_no', 'reservation_id'];

    public function gender()
    {
    	switch($this->gender)
    	{
    		case 0:
    			return 'Male';
    			break;
    		case 1:
    			return 'Female';
    			break;
    		default:
    			return 'Male';
    	}
    }

    public function cruise()
    {
    	$this->belongsTo('App\Cruise');
    }

    public function reservation()
    {
    	$this->belongsTo('App\Reservation');
    }
}
