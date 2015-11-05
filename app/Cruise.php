<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cruise extends Model
{
    //
    protected $fillable = ['name', 'price', 'depart_location', 'arrive_location', 'type', 'depart_date', 'arrive_date', 'description'];


    //Get all of the cabins for the cruise
    public function cabins()
    {
    	return $this->belongsToMany('App\Cabin');
    }

    public function date()
    {
    	return $this->depart_date . ' - ' . $this->arrive_date;
    }
}
