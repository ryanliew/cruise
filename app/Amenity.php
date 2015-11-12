<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    //
    protected $table = 'amenities';
    protected $fillable = ['name', 'price', 'image', 'description'];

    public function promotions()
    {
    	return $this->belongsTo('App/Promotion');
    }

    public function reservations()
    {
    	return $this->belongsToMany('App/Reservation', 'reservations_amenities', 'amenity_id', 'reservation_id')->withTimestamps()->withPivot('promotion_id');
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
}
