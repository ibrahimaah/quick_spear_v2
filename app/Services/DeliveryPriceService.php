<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\City;
use App\Models\DeliveryPrice;
use App\Models\Region;
use Exception;

class DeliveryPriceService
{

    public function store($data,$has_regions = false)
    {
        try 
        {
            if (!$has_regions) 
            {
                $delivery_price = DeliveryPrice::create($data);
            }
            else 
            {
                $delivery_price = DeliveryPrice::insert($data);
            }


            if ($delivery_price) 
            {
                return ['code' => 1 , 'data' => true];
            }
            else
            {
                throw new Exception('Can not store this deliveryPrice');
            }
           
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }


    public function update($new_price,$id)
    {
        try 
        {
            $delivery_price = DeliveryPrice::findOrFail($id);
            $delivery_price->price = $new_price;
            if ($delivery_price->save()) 
            {
                return ['code' => 1 , 'data' => true];
            }
            else
            {
                throw new Exception('Can not update this deliveryPrice');
            }
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

    public function destroy($id)
    {
        try 
        {
            $delivery_price = DeliveryPrice::findOrFail($id);
            if ($delivery_price->delete()) 
            {
                return ['code' => 1 , 'data' => true];
            }
            else
            {
                throw new Exception('Can not delete this deliveryPrice');
            }
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

    public function getDeliveryPrice($bill_id)
    {
        try 
        {
            $bill = Bill::findOrFail($bill_id);

            $deliveryPrice = $this->getPriceForLocation($bill->shop_id, $bill->consignee_region, Region::class)
                            ?? $this->getPriceForLocation($bill->shop_id, $bill->consignee_city, City::class);

            return ['code' => 1, 'data' => $deliveryPrice];
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }


    private function getPriceForLocation($shopId, $locationId, $locationType)
    {
        if ($locationId) {
            return DeliveryPrice::where('shop_id', $shopId)
                                ->where('location_type', $locationType)
                                ->where('location_id', $locationId)
                                ->value('price');
        }
        return null;
    }
}