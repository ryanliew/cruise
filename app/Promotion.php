<?php

namespace App;
use App\Cruise;
use DB;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //
    protected $fillable = ['name', 'image', 'discount', 'description', 'type'];

    public function cabins()
    {
    	return $this->hasMany('App\Cabin', 'promotion_id');
    }

    public function amenities()
    {
    	return $this->hasMany('App\Amenity', 'promotion_id');
    }

    public function cruises()
    {
        return $this->hasMany('App\Cruise', 'promotion_id');
    }

    public function date()
    {
        $depart = DateTime::createFromFormat('Y-m-d', $this->start_date)->format('m/d/Y');
        $arrive = DateTime::createFromFormat('Y-m-d', $this->end_date)->format('m/d/Y');
        return $depart . ' - ' . $arrive;
    }

    public function type()
    {
        switch($this->type)
        {
            case 1:
                return 'Cruise';
            case 2:
                return 'Cabin';
            case 3:
                return 'Amenity';
        }
    }

    public function status()
    {
        switch($this->status)
        {
            case 0:
                $status = ['color' => 'green','name' => 'active'];
                break;
            case 1:
                $status = ['color' => 'red','name' => 'inactive'];
        }
        return $status;
    }

    public function appliedCount()
    {
        switch($this->type)
        {
            case 1:
                return DB::table('cruises')
                    ->where('promotion_id', '=', $this->id)
                    ->count();
            case 2:
                return DB::table('cabins')
                    ->where('promotion_id', '=', $this->id)
                    ->count();
            case 3:
                return DB::table('amenities')
                    ->where('promotion_id', '=', $this->id)
                    ->count();
        }
    }
}
