<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //
    protected $fillable = ['name'];

    public function cabins()
    {
    	return $this->belongsToMany('App/Cabin');
    }

    public function amenities()
    {
    	return $this->belongsToMany('App/Amenity');
    }
}
