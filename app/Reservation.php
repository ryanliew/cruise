<?php

namespace App;
use App\Amenity as Amenity;
use App\Cabin;
use App\Cruise;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    protected $fillable = ['user_id', 'cruise_id', 'price', 'status', 'cabin_id', 'payment_id'];
    protected $guarded = ['id'];

    public function amenities()
    {
    	return $this->belongsToMany('App\Amenity');
    }

    public function cabin()
    {
    	return $this->belongsTo('App\Cabin');
    }

    public function cruise()
    {
        return $this->belongsTo('App\Cruise');
    }

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function passengers()
    {
        return $this->hasMany('App\Passenger');
    }
    public function total()
    {
    	return $this->price + ($this->price/10);
    }

    public function status()
    {
        $status = ['color' => 'success','name' => 'paid'];
        switch($this->status)
        {
            case 0:
                $status = ['color' => 'warning','name' => 'pending'];
                break;
            case 2:
                $status = ['color' => 'danger','name' => 'canceled'];
        }
        return $status;
    }
}
