<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    //
    protected $table = 'amenities';
    protected $fillable = ['name'];

    public function promotions()
    {
    	return $this->belongsToMany('App/Promotion');
    }

    public function reservations()
    {
    	return $this->belongsToMany('App/Reservation');
    }
}
