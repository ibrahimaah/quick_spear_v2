<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\CityDelegate;
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
                $not_important_statuses = [ShipmentStatus::POSTPONED,
                                           ShipmentStatus::CANCELED,
                                           ShipmentStatus::UNDER_DELIVERY,
                                           ShipmentStatus::UNDER_REVIEW,
                                           ShipmentStatus::REJECTED_WITHOUT_PAY,
                                           ShipmentStatus::NO_RESPONSE];

                

                $total_due_to_customer_amount = 0;

                foreach ($bill_orders as $bill_order) 
                {

                    if (in_array($bill_order->shipment_status_id,$not_important_statuses)) 
                    {
                        continue;
                    }
                    elseif ($bill_order->shipment_status_id == ShipmentStatus::DELIVERED)  
                    { 
                        $total_due_to_customer_amount += ($bill_order->value_on_delivery - $bill_order->customer_delivery_price);
                    }
                    elseif ($bill_order->shipment_status_id == ShipmentStatus::REJECTED_WITH_PAY) 
                    {
                        //in this state we have to pay to the shop what ever amount over the delegate price
                        $delegate_price = CityDelegate::where('city_id',$bill_order->consignee_city )->where('delegate_id',$bill_order->delegate_id)->value('price');
                        $value_from_client = $bill_order->value_on_delivery;
                        if ($value_from_client > $delegate_price) 
                        {
                            $total_due_to_customer_amount += $value_from_client - $delegate_price;
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

    public function get_amount_due_from_customer($bill_orders)
    {
        try 
        {
            if ($bill_orders->isEmpty()) 
            {
                return ['code' => 1 , 'data' => 0];
            }
            else 
            {
                $not_important_statuses = [ShipmentStatus::POSTPONED,
                                           ShipmentStatus::CANCELED,
                                           ShipmentStatus::UNDER_DELIVERY,
                                           ShipmentStatus::UNDER_REVIEW,
                                           ShipmentStatus::DELIVERED,
                                           ];

                

                $total_due_from_customer_amount = 0;

                foreach ($bill_orders as $bill_order) 
                {

                    if (in_array($bill_order->shipment_status_id,$not_important_statuses)) 
                    {
                        continue;
                    }
                    elseif (in_array($bill_order->shipment_status_id ,[ShipmentStatus::REJECTED_WITHOUT_PAY,ShipmentStatus::NO_RESPONSE]))  
                    { 
                        $total_due_from_customer_amount += $bill_order->customer_delivery_price;
                    }
                    elseif ($bill_order->shipment_status_id == ShipmentStatus::REJECTED_WITH_PAY) 
                    {
                        //in this state , the shop must pay to delegate if the client does not pay the total delegate price
                        $delegate_price = CityDelegate::where('city_id',$bill_order->consignee_city )->where('delegate_id',$bill_order->delegate_id)->value('price');
                        $value_from_client = $bill_order->value_on_delivery;
                        if ($value_from_client < $delegate_price) 
                        {
                            $total_due_from_customer_amount += $delegate_price - $value_from_client;
                        }
                        
                    }
                }

                return ['code' => 1, 'data' => $total_due_from_customer_amount];
            }
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }

    

    
}

