<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\BillStatus;
use App\Models\BillTracking;
use App\Models\CityDelegate;
use App\Models\Shipment;
use App\Models\ShipmentStatus;
use App\Models\Shop;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use PDF;

use function PHPUnit\Framework\isEmpty;

class BillService
{
    public function get_bills_by_shop_id_and_bill_status($shop_id,$bill_status_id=null)
    {
        try 
        {
            
            $shop = Shop::findOrFail($shop_id);

            if ($bill_status_id) 
            {
                $shop_bills = BillTracking::where('shop_id', $shop->id)
                                  ->where('bill_status_id', $bill_status_id)->orderBy('id','DESC')
                                  ->get();
            }
            else 
            {
                $shop_bills = BillTracking::where('shop_id', $shop->id)->orderBy('id','DESC')->get();
            }
            
             
           if ($shop_bills->isNotEmpty()) 
           {
                return ['code' => 1, 'data' => $shop_bills];
           }
           else
           { 
                return ['code' => 1, 'data' => new Collection()];
           }
            
        } 
        catch (Exception $ex) 
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }


    public function get_amount_due_from_and_to_customer($bill_orders)
    {
        try 
        {
            if ($bill_orders->isEmpty()) 
            {
                return ['code' => 1 , 'data' => 0];
            }
            else 
            {
                //those statuses have value_on_delivery = 0
                $not_important_statuses = [ShipmentStatus::POSTPONED,
                                           ShipmentStatus::CANCELED,
                                           ShipmentStatus::UNDER_DELIVERY,
                                           ShipmentStatus::UNDER_REVIEW];

                

                $total_due_to_customer_amount = 0;
                $total_due_from_customer_amount = 0;
                $total_value_on_delivery = 0;
                $total_customer_delivery_price = 0;

                foreach ($bill_orders as $bill_order) 
                {

                    if (in_array($bill_order->shipment_status_id,$not_important_statuses)) 
                    {
                        continue;
                    }
                    else 
                    {
                        $total_value_on_delivery += $bill_order->value_on_delivery;
                        $total_customer_delivery_price += $bill_order->customer_delivery_price;
                    }
                   
                }


                // if ($total_value_on_delivery > $total_customer_delivery_price) 
                // {
                //     $total_due_to_customer_amount = $total_value_on_delivery - $total_customer_delivery_price;
                //     $total_due_from_customer_amount = 0;
                // }
                // else 
                // {
                //     $total_due_from_customer_amount = $total_customer_delivery_price - $total_value_on_delivery;
                //     $total_due_to_customer_amount =0;
                // }

                return ['code' => 1, 'data' => ['total_value_on_delivery' => $total_value_on_delivery ,
                                                'total_customer_delivery_price' => $total_customer_delivery_price]];
            }
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
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
                        // $delegate_price = CityDelegate::where('city_id',$bill_order->consignee_city )->where('delegate_id',$bill_order->delegate_id)->value('price');
                        // $value_from_client = $bill_order->value_on_delivery;
                        // if ($value_from_client > $delegate_price) 
                        // {
                        //     $total_due_to_customer_amount += $value_from_client - $delegate_price;
                        // } 

                        $value_from_client = $bill_order->value_on_delivery;
                        $customer_delivery_price = $bill_order->customer_delivery_price;
                        if ($value_from_client > $customer_delivery_price) 
                        {
                            $total_due_to_customer_amount += $value_from_client - $customer_delivery_price;
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
                                           ShipmentStatus::REJECTED_WITH_PAY
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
                    // elseif ($bill_order->shipment_status_id == ShipmentStatus::REJECTED_WITH_PAY) 
                    // {
                    //     //in this state , the shop must pay to delegate if the client does not pay the total delegate price
                    //     $delegate_price = CityDelegate::where('city_id',$bill_order->consignee_city )->where('delegate_id',$bill_order->delegate_id)->value('price');
                    //     $value_from_client = $bill_order->value_on_delivery;
                    //     if ($value_from_client < $delegate_price) 
                    //     {
                    //         $total_due_from_customer_amount += $delegate_price - $value_from_client;
                    //     }
                        
                    // }
                }

                return ['code' => 1, 'data' => $total_due_from_customer_amount];
            }
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }


    public function update_bill_status($bill_number,$bill_status_id)
    {
        try 
        {
             $bill_tracking = BillTracking::where('bill_number',$bill_number)->first();
             if ($bill_tracking) 
             {
                $bill_tracking->bill_status_id = $bill_status_id;
                if ($bill_tracking->save()) 
                {
                    return ['code' => 1 , 'data' => true];
                }
             }
             else 
             {
                throw new Exception("There is no bill tracking record for bill_number $bill_number");
             }
            
            
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }

    
    public function remove($bill_number)
    {
        DB::beginTransaction();

        try 
        {
            $bill_tracking = BillTracking::where('bill_number', $bill_number)->first();

            if ($bill_tracking) 
            {
                // Delete the related bills first
                Bill::where('bill_tracking_id', $bill_tracking->id)->delete();
                
                // Then delete the bill_tracking
                $bill_tracking->delete();
                
                DB::commit(); // Commit only if everything is successful

                return ['code' => 1, 'data' => true];
            } 
            else 
            {
                DB::rollBack(); // Rollback if $bill_tracking is not found
                throw new Exception("There is no bill_tracking record with bill_number : $bill_number");
            }
        } 
        catch (Exception $ex) {
            DB::rollBack(); // Rollback in case of any exceptions
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }

        
    }

    public function get_total_due_to_customer_amount($shop_id=null)
    {
        try 
        {
            if ($shop_id) 
            { 
                $total_due_to_customer_amount = BillTracking::where('bill_status_id',BillStatus::UNDER_REVIEW)->where('shop_id',$shop_id)->sum('bill_value');
            }
            else 
            {
                $total_due_to_customer_amount = BillTracking::where('bill_status_id',BillStatus::UNDER_REVIEW)->sum('bill_value');
            }
            return ['code' => 1 , 'data' => $total_due_to_customer_amount]; 
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }

 
    
    public function prepare_bill($bill_number)
    {
        
       try 
       {
            $bill_tracking = BillTracking::where('bill_number',$bill_number)->firstOrFail();

            $shop = $bill_tracking->shop; 

            $client_name = $shop->user->name;

            $bill_date_day = get_arabic_day_from_bill_number($bill_number);

            $bill_date =Carbon::parse($bill_tracking->bill_date)->format('Y-m-d');

            //DELIVERED is always the first
            $orders = $bill_tracking->bills->sort(function ($a, $b) {
                if ($a->shipment_status_id === ShipmentStatus::DELIVERED) {
                    return -1;
                } elseif ($b->shipment_status_id === ShipmentStatus::DELIVERED) {
                    return 1;
                } else {
                    return $a->shipment_status_id <=> $b->shipment_status_id;
                }
            });
            // dd($orders);
             

            $res_get_amount_due_from_and_to_customer = $this->get_amount_due_from_and_to_customer($orders);
            
            if ($res_get_amount_due_from_and_to_customer['code'] == 0) 
            {
                throw new Exception($res_get_amount_due_from_and_to_customer['msg']);
            }

            $total_value_on_delivery = $res_get_amount_due_from_and_to_customer['data']['total_value_on_delivery'];
            $total_customer_delivery_price = $res_get_amount_due_from_and_to_customer['data']['total_customer_delivery_price'];

            if ($total_value_on_delivery > $total_customer_delivery_price) 
            {
                $total_due_to_customer_amount = $total_value_on_delivery - $total_customer_delivery_price;
                $total_due_from_customer_amount = 0;
            } 
            else 
            {
                $total_due_from_customer_amount = $total_customer_delivery_price - $total_value_on_delivery;
                $total_due_to_customer_amount = 0;
            }

            BillTracking::where('bill_number', $bill_number)
                        ->update(['bill_value' => $total_due_to_customer_amount]);
            
            

            $pdf = PDF::loadView('admin.transactions.bill', compact(
                'orders', 
                'shop', 
                'bill_number', 
                'client_name', 
                'bill_date_day', 
                'bill_date', 
                'total_value_on_delivery', 
                'total_customer_delivery_price', 
                'total_due_to_customer_amount', 
                'total_due_from_customer_amount',
            ));
            
            return $pdf->stream('bill-'.$bill_number.'.pdf');
       }
       catch(Exception $ex)
       {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
       }
       
        
    }
    
}

