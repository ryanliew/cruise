<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabin extends Model
{
    //
    protected $fillable = ['name'];

    public function cruises()
    {
    	return $this->belongsToMany('App/Cruise');
    }

    public function reservations()
    {
    	return $this->belongsToMany('App/Reservation');
    }

    public function promotions()
    {
    	return $this->belongsToMany('App/Promotion');
    }
}
