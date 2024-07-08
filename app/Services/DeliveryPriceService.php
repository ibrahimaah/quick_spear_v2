<?php

namespace App\Services;

use App\Models\DeliveryPrice;
use Exception;

class DeliveryPriceService
{

    public function store($data)
    {
        try 
        {
            $delivery_price = DeliveryPrice::create($data);
            if ($delivery_price->save()) 
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
}