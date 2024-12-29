<?php

namespace App\Services;

use App\Models\City;
use App\Models\Region; 
use App\Models\Return;
use App\Models\ReturnStatus;
use App\Models\Shipment;
use Exception; 

class ShipmentReturnService
{
    public function remove_all()
    {
        try 
        {
            Shipment::where(function ($shipment) {
                $shipment->whereIn('shipment_status_id', [ReturnStatus::DELIVERED_TO_THE_SHOP])
                    ->orWhere('is_returned', true);
            })
            ->where('is_deported', true)
            ->where('return_status_id', '<>', ReturnStatus::DELETED)
            ->update(['return_status_id' => ReturnStatus::DELETED]);
    
            
            return ['code' => 1 , 'data' => true];
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }
}