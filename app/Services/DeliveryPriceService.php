<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\City;
use App\Models\DeliveryPrice;
use App\Models\Region;
use App\Models\Shipment;
use Exception;
use Illuminate\Support\Facades\DB;

class DeliveryPriceService
{

    public function store($data)
    {
        try 
        {
            DB::beginTransaction();

            foreach ($data as $entry) 
            {
                // Check if the price already exists for the given combination
                $exists = DeliveryPrice::where('shop_id', $entry['shop_id'])
                                       ->where('location_type', $entry['location_type'])
                                       ->where('location_id', $entry['location_id']) 
                                       ->exists();

                // dd($exists);
                if (!$exists) 
                { 
                    // Insert the record if it doesn't exist
                    $deliveryPrice = DeliveryPrice::create($entry); // Use create() for single insertions
                    if(!$deliveryPrice)
                    {
                        throw new Exception("Can not create DeliveyPrice");
                    }
                }
                else 
                {
                    continue; // Skip the insertion for this entry
                }   
            }

            DB::commit();
            return ['code' => 1 , 'data' => true];  
        }
        catch(Exception $ex)
        {
            DB::rollBack();
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

    public function getDeliveryPrice($shipment_id)
    {
        try 
        {
            $shipment = Shipment::findOrFail($shipment_id);

            $region_delivery_price = $this->getPriceForLocation($shipment->shop_id, $shipment->consignee_region, Region::class);
            if (!$region_delivery_price) 
            {
                $city_delivery_price = $this->getPriceForLocation($shipment->shop_id, $shipment->consignee_city, City::class);
                if (!$city_delivery_price) 
                {
                    throw new Exception("Delivery Price is not set for city : ".$shipment->city->name. " for user : ".$shipment->shop->user->name." for shop: ".$shipment->shop->name);
                }
                else 
                {
                    return ['code' => 1, 'data' => $city_delivery_price];
                }
            }
            else 
            {
                return ['code' => 1, 'data' => $region_delivery_price];
            }
                            

            
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