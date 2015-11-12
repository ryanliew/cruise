<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cabin;
use App\Cruise;
use App\Amenity;
use App\Promotion;
use \Input as Input;
use DateTime;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    //
    /**
     * Create new controller instance.
     *
     */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function getPromotionList()
    {
        $promotions = Promotion::all();
        return view('admin.promotions', [
            'promotions' => $promotions,
            ]);
    }

    public function getPromotionForm()
    {
    	$cabins = Cabin::all();
    	$cruises = Cruise::all();
        $amenities = Amenity::all();
    	return view('admin.promotion', [
            'cabins' => $cabins,
    		'cruises' => $cruises,
            'amenities' => $amenities,
    		]);
    }

    public function getUpdatePromotionForm(Request $request, Promotion $promotion)
    {
    	$cabins = Cabin::all();
        $cruises = Cruise::all();
        $amenities = Amenity::all();
        return view('admin.editpromotion', [
            'cabins' => $cabins,
            'cruises' => $cruises,
            'amenities' => $amenities,
            'promotion' => $promotion
            ]);
    }

    public function updatePromotion(Request $request, Promotion $promotion)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'discount' => 'required|numeric|min:1|max:100',
            'type' => 'required|numeric|min:1|max:100',
            'image' => 'image',
            'promo_date' => 'max:23',

            ]);
        $name = $request->name;
        $discount = $request->discount;
        $type = $request->type;
        $description = $request->description;

        if(!empty($request->promo_date))
        {
            $dates = explode(" - ", $request->promo_date);
            $promotion->start_date = DateTime::createFromFormat('m/d/Y', $dates[0])->format('Y-m-d');
            $promotion->end_date = DateTime::createFromFormat('m/d/Y', $dates[1])->format('Y-m-d');
                    //check if promotion is activated on create
            if($dates[0] <= new DateTime("now") && $dates[1] > new DateTime("now"))
            {
                $promotion_status = 1;
            } else {
                $promotion_status = 0;
            }
        }

        if(Input::hasFile('image'))
        {
            if(File::exists('uploads/' . $cruise->image))
                File::delete('uploads/' . $cruise->image);
            $file = Input::file('image');
            $imagename = 'promotion_' . $promotion->id . '.' . Input::file('image')->getClientOriginalExtension();
            $file->move('uploads', $imagename);
            $promotion->image = $imagename;
        }

        switch($request->type)
        {
            case 1:
                DB::table('cruises')
                    ->where('promotion_id', '=', $promotion->id)
                    ->update(['promotion_id' => NULL]);
                $selcruises = Input::get('cruises');
                foreach($selcruises as $key => $val)
                {
                    $cruise = Cruise::find($val);
                    $cruise->promotion_id = $promotion->id;
                    $cruise->save();
                }
                break;
            case 2:
                DB::table('cabins')
                    ->where('promotion_id', '=', $promotion->id)
                    ->update(['promotion_id' => NULL]);
                $cabins = Input::get('cabins');
                foreach($cabins as $key => $val)
                {
                    $cabin = Cabin::find($val);
                    $cabin->promotion_id = $promotion->id;
                    $cabin->save();
                }
                break;
            case 3:
                DB::table('amenitites')
                    ->where('promotion_id', '=', $promotion->id)
                    ->update(['promotion_id' => NULL]);
                $amenities = Input::get('amenities');
                foreach($amenities as $key => $val)
                {
                    $amenity = Amenity::find($val);
                    $amenity->promotion_id = $promotion->id;
                    $amenity->save();
                }
        }
        $promotion->save();
        return redirect('/admin/promotion/' . $promotion->id)->with('status', 'Promotion updated!');
    }

    public function postNewPromotion(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'discount' => 'required|numeric|min:1|max:100',
            'type' => 'required|numeric|min:1|max:100',
            'image' => 'image',
            'promo_date' => 'max:23',
            ]);
        
        //create a new promotion
        $promotion = Promotion::create([
            'name' => $request->name,
            'discount' => $request->discount,
            'type' => $request->type,
            'description' => $request->description,
            ]);

        //process dates
        if(!empty($request->promo_date))
        {
            $dates = explode(" - ", $request->promo_date);
            $promotion->start_date = DateTime::createFromFormat('m/d/Y', $dates[0])->format('Y-m-d');
            $promotion->end_date = DateTime::createFromFormat('m/d/Y', $dates[1])->format('Y-m-d');
                    //check if promotion is activated on create
            if($dates[0] <= new DateTime("now") && $dates[1] > new DateTime("now"))
            {
                $promotion_status = 1;
            } else {
                $promotion_status = 0;
            }
        }


        if(Input::hasFile('image'))
        {
            $file = Input::file('image');
            $imagename = 'promotion_' . $promotion->id . '.' . Input::file('image')->getClientOriginalExtension();
            $file->move('uploads', $imagename);
            $promotion->image = $imagename;
        }

        $promotion->save();

        //attach promotion to selected items
        $cruises = Input::get('cruises');
        $cabins = Input::get('cabins');
        $amenities = Input::get('amenities');
        if(!empty($cruises))
        {
            foreach($cruises as $key => $val)
            {
                $cruise = Cruise::find($val);
                $cruise->promotion_id = $promotion->id;
                $cruise->save();
            }
        }
        else if(!empty($cabins))
        {
            foreach($cabins as $key => $val)
            {
                $cabin = Cabin::find($val);
                $cabin->promotion_id = $promotion->id;
                $cabin->save();
            }
        }
        else if(!empty($amenities))
        {
            foreach($amenities as $key => $val)
            {
                $amenity = Amenity::find($val);
                $amenity->promotion_id = $promotion->id;
                $amenity->save();
            }
        }

        return redirect('/admin/promotion/' . $promotion->id)->with('status', 'Promotion created!');
    }
}
