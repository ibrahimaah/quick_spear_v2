<?php

namespace App\Services;

use App\Models\City;
use App\Models\CityDelegate;
use App\Models\Delegate;
use Exception; 

class CityDelegateService
{
    public function getDelegateDeliveryPrice($delegate_id,$city_id)
    {
        try 
        {
            $delegate_delivery_price = CityDelegate::where('delegate_id',$delegate_id)->where('city_id',$city_id)->value('price');
            // throw new Exception($delegate_delivery_price);

            if (!$delegate_delivery_price) 
            {
                $delegateName = Delegate::findOrFail($delegate_id);
                $cityName     = City::findOrFail($city_id);
                throw new Exception('not set delivery price for '.$delegateName.' for city '.$cityName);
            }
            return ['code' => 1, 'data' => $delegate_delivery_price];
        } 
        catch (Exception $ex) 
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }
}
