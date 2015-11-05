<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    public function amenities()
    {
    	return $this->belongsToMany('App/Amenity');
    }

    public function cabins()
    {
    	return $this->belongsToMany('App/Cabin');
    }
}
