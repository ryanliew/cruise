<?php

namespace App;
use DateTime;
use DB;
use Illuminate\Database\Eloquent\Model;

class Cruise extends Model
{
    //
    protected $fillable = ['name', 'image', 'price', 'depart_location', 'arrive_location', 'type', 'depart_date', 'arrive_date', 'description'];


    //Get all of the cabins for the cruise
    public function cabins()
    {
    	return $this->belongsToMany('App\Cabin', 'cruises_cabins')->withPivot('cabin_booked', 'cabin_number')->withTimestamps();
    }

    public function location()
    {
        return $this->depart_location . ' - ' . $this->arrive_location;
    }

    public function reservation()
    {
        return $this->hasMany('App\Reservation');
    }

    public function passengers()
    {
        return $this->hasMany('App\Passenger');
    }

    public function date()
    {
        $depart = DateTime::createFromFormat('Y-m-d', $this->depart_date)->format('m/d/Y');
        $arrive = DateTime::createFromFormat('Y-m-d', $this->arrive_date)->format('m/d/Y');
        return $depart . ' - ' . $arrive;
    }

    public function shortdate()
    {
        $depart = DateTime::createFromFormat('Y-m-d', $this->depart_date)->format('m/d');
        $arrive = DateTime::createFromFormat('Y-m-d', $this->arrive_date)->format('m/d');
        return $depart . ' - ' . $arrive;
    }

    public function price()
    {
        if(!empty($this->promotion_id)):
            $price = $this->price - ( $this->price * ( $this->promotion->discount / 100 ));
        else :
            $price = $this->price;
        endif;
        return $price;
    }

    public function pricepernight()
    {
        return number_format( $this->price()/$this->duration(), 2, ".", ",");
    }

    public function hasDiscount()
    {
        return !empty($this->promotion_id);
    }

    public function duration()
    {
        $depart = DateTime::createFromFormat('Y-m-d', $this->depart_date);
        $arrive = DateTime::createFromFormat('Y-m-d', $this->arrive_date);
        return $depart->diff($arrive)->days;
    }

    public function status()
    {
        $status = ['color' => 'green','name' => 'active'];
        switch($this->status)
        {
            case 1:
                $status = ['color' => 'yellow','name' => 'full'];
                break;
            case 2:
                $status = ['color' => 'red','name' => 'canceled'];
                break;
            case 3:
                $status = ['color' => 'blue', 'name' => 'departed'];
                break;
        }
        return $status;
    }

    public function promotions()
    {
        return $this->belongsTo('App\Promotion');
    }
    
    public function capacity()
    {
        $capacity = 0;
        foreach($this->cabins as $cabin)
            $capacity += $cabin->pivot->cabin_number;
        return $capacity;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 0);
    }

    public function scopeLastMinute($query)
    {
        return $query->whereRaw("DATEDIFF(depart_date, NOW()) < 3");
    }
}
