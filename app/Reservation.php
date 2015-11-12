<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    public function amenities()
    {
    	return $this->belongsToMany('App/Amenity', 'reservations_amenities');
    }

    public function cabins()
    {
    	return $this->belongsToMany('App/Cabin', 'reservations_cabins');
    }
}
