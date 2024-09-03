<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Shipment;
use App\Models\ShipmentStatus;
use App\Models\Shop;
use Exception;
use Illuminate\Support\Facades\Auth;

class BillService
{
    public function get_bills_by_shop_id($shop_id)
    {
        try 
        {
            $shop = Shop::findOrFail($shop_id);
            $shop_bills = $shop->bills->groupBy('bill_number');
            return ['code' => 1, 'data' => $shop_bills];
        } 
        catch (Exception $ex) 
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

 

    public function get_amount_due_to_customer($bill_orders)
    {
        try 
        {
            if ($bill_orders->isEmpty()) 
            {
                return ['code' => 1 , 'data' => 0];
            }
            else 
            {
                $total_value_on_delivery = 0;

                $not_important_statuses = [ShipmentStatus::POSTPONED,
                                           ShipmentStatus::CANCELED,
                                           ShipmentStatus::UNDER_DELIVERY,
                                           ShipmentStatus::UNDER_REVIEW];

                

                $total_due_to_customer_amount = 0;

                foreach ($bill_orders as $bill_order) 
                {
                    if (in_array($bill_order->shipment_status_id,$not_important_statuses)) {
                        continue;
                    }
                    else 
                    { 
                        if (in_array($bill_order->shipment_status_id, [ShipmentStatus::REJECTED_WITHOUT_PAY,ShipmentStatus::NO_RESPONSE])) 
                        {
                            $res_get_delivery_price = (new DeliveryPriceService())->getDeliveryPrice($bill_order->id);
                            if ($res_get_delivery_price['code'] == 1) 
                            {
                                $delivery_price = $res_get_delivery_price['data'];
                                $total_due_to_customer_amount += $delivery_price;
                            }
                            else 
                            {
                                dd($res_get_delivery_price['msg']);
                            }
                            
                        }

                        if (in_array($bill_order->shipment_status_id , [ShipmentStatus::DELIVERED , ShipmentStatus::REJECTED_WITH_PAY])) 
                        {
                            $res_get_delivery_price = (new DeliveryPriceService())->getDeliveryPrice($bill_order->id);
                            if ($res_get_delivery_price['code'] == 0){
                                dd($res_get_delivery_price['msg']);
                            } 
                            $total_due_to_customer_amount+=($bill_order->value_on_delivery - $res_get_delivery_price['data']);
                        } 
                     
                    }
                    
                }

                return ['code' => 1, 'data' => $total_due_to_customer_amount];
            }
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }
}