<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','name','city_id','region','description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }
    

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function deliveryPrices()
    {
        return $this->hasMany(DeliveryPrice::class);
    }

    // function getDeliveryPrice($location_id, $isRegion = false)
    // {
    //     // Determine the location type based on the $isRegion flag
    //     $locationType = $isRegion ? Region::class : City::class;
    
    //     // Retrieve the delivery price for the specific shop and location
    //     $deliveryPrice = DeliveryPrice::where('shop_id', $this->id)
    //         ->where('location_type', $locationType)
    //         ->where('location_id', $location_id)
    //         ->value('price');
    
    //     return $deliveryPrice;
    // }


   
    
    
    
}
