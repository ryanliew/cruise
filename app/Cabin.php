<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Cabin extends Model
{
    //
    protected $fillable = ['name', 'size', 'price', 'description', 'image'];
    protected $guarded = ['id'];

    public function cruises()
    {
    	return $this->belongsToMany('App\Cruise', 'cruises_cabins')->withTimestamp()->withPivot('cabin_booked', 'cabin_number');
    }

    public function reservation()
    {
    	return $this->hasMany('App\Reservation');
    }

    public function promotions()
    {
    	return $this->belongsTo('App\Promotion');
    }

    public function pricepernight($night)
    {
        return number_format( $this->price()/$night, 2, ".", ",");
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

    public function hasDiscount()
    {
        return !empty($this->promotion_id);
    }
}
