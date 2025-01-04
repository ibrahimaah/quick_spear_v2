<?php

namespace App\Services;

use App\Http\Controllers\Admin\DelegateController;
use App\Models\Address;
use App\Models\Bill;
use App\Models\BillStatus;
use App\Models\BillTracking;
use App\Models\City;
use App\Models\Delegate; 
use App\Models\LastDeportationLog;
use App\Models\Shipment;
use App\Models\ShipmentStatus;
use App\Models\Statement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DelegateService
{
    public function store($data)
    {
        try 
        {
            $delegate_table_data = [
                'name' => $data['name'],
                'phone' => $data['phone'],
            ];

            $delegate = Delegate::Create($delegate_table_data);

            if ($delegate) 
            {
                $delegate_pivote_data = $data['delegates'];
                // Attach delegate to each city with price
                foreach ($delegate_pivote_data as $delegate_pivote_row) {
                    $cityId = $delegate_pivote_row['city'];
                    $price = $delegate_pivote_row['price'];
                    $delegate->cities()->attach($cityId, ['price' => $price]);
                }
                
                return ['code' => 1, 'data' => $delegate];
            } 
            else 
            {
                throw new Exception('Error assign delegate');
            }
        } 
        catch (Exception $ex) 
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }
    // public function update($delegate_id,$data,$cities)
    // {
    //     try 
    //     {
    //         $delegate = Delegate::findOrFail($delegate_id);

    //         $affectedRows =  $delegate->update($data);

    //         if ($affectedRows > 0) 
    //         {
    //             $delegate->cities()->sync($cities);
    //             return ['code' => 1, 'data' => true];
    //         } 
    //         else 
    //         {
    //             throw new Exception('Error assign delegate');
    //         }
    //     } 
    //     catch (Exception $ex) 
    //     {
    //         return ['code' => 0, 'msg' => $ex->getMessage()];
    //     }
    // }

  
    public function update($data,$delegate)
    {
        try 
        {
            $delegate_table_data = [
                'name' => $data['name'],
                'phone' => $data['phone'],
            ];

            $delegate->update($delegate_table_data);

            
            // Prepare pivot data
            $delegate_pivot_data = [];
            foreach ($data['delegates'] as $delegate_pivot_row) {
                $cityId = $delegate_pivot_row['city'];
                $price = $delegate_pivot_row['price'];
                $delegate_pivot_data[$cityId] = ['price' => $price];
            }

            // Sync pivot data
            $delegate->cities()->sync($delegate_pivot_data);
            
            return ['code' => 1, 'data' => $delegate];
          
        } 
        catch (Exception $ex) 
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }


    public function get_delegates_by_city_id($city_id)
    {
        try 
        {
            $city = City::findOrFail($city_id);
            $delegates = $city->delegates;
            if ($delegates->isNotEmpty()) 
            {
                return ['code' => 1 , 'data' => $delegates];
            }
            else 
            {
                throw new Exception("no delegates for selected city");
            }
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }


    public function get_delegates_by_shipments_ids($shipments_ids)
    {
        try 
        {
            $cities_ids = [];
            foreach($shipments_ids as $shipment_id)
            {
                $shipment = Shipment::findOrFail($shipment_id);
                $cities_ids[] = $shipment->consignee_city;
            }
            $cities_ids = array_unique($cities_ids);

            $cities_count = count($cities_ids);

            $delegates = Delegate::whereHas('cities', function ($query) use ($cities_ids, $cities_count) {
                $query->whereIn('city_id', $cities_ids)
                    ->groupBy('delegate_id')
                    ->havingRaw("COUNT(DISTINCT city_id) = ?", [$cities_count]);
            })->get();

            if ($delegates->isNotEmpty()) 
            {
                return ['code' => 1 , 'data' => $delegates];
            }
            else 
            {
                throw new Exception("no delegates for selected city");
            }
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }
    public function get_delegates_by_city_name($city_name)
    {
        try 
        {
            $city = City::where('name',$city_name)->first();
            $delegates = $city->delegates;
            if ($delegates->isNotEmpty()) 
            {
                return ['code' => 1 , 'data' => $delegates];
            }
            else 
            {
                throw new Exception("no delegates for selected city");
            }
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

    //i.e ex. all shipments of delegate Ahmad has status of Under Delivery
    public function chk_all_delegate_shipments_has_status(Delegate $delegate, $status)
    {
        try 
        {
            $shipments = $delegate->nonDeportedShipments();
            
            if ($shipments->isEmpty()) 
            {
                throw new Exception('This delegate does not have any shipment');
            }
            
            $result = $shipments->every(function ($shipment) use ($status) {
                return in_array($shipment->shipment_status_id , $status);
            });
            
            return ['code' => 1, 'data' => $result];
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }


    public function chk_all_delegate_shipments_not_has_status(Delegate $delegate, $status)
    {
        try 
        {
            $shipments = $delegate->shipments->where('is_deported', false);
    
            if ($shipments->isEmpty()) 
            {
                throw new Exception('This delegate does not have any shipment');
            }
    
            // Ensure $status is an array
            $statusArray = is_array($status) ? $status : [$status];
    
            $result = $shipments->every(function ($shipment) use ($statusArray) {
                return !in_array($shipment->shipment_status_id, $statusArray);
            });
    
            return ['code' => 1, 'data' => $result];
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }
    
    public function is_last_deported_report()
    {
        try 
        {
            $delegates = Delegate::all();
            foreach ($delegates as $delegate) 
            {
                $shipments = $delegate->shipments()->nonDeported()->where('shipment_status_id', '!=',ShipmentStatus::POSTPONED)->get();

                if ($shipments->isNotEmpty()) 
                {
                    return ['code' => 1 , 'data' => false];
                }
                continue;
            }

            return ['code' => 1 , 'data' => true];
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }

    public function deport(Delegate $delegate)
    {
        
        DB::beginTransaction();
       
        try 
        {
            $deportation_group_id = LastDeportationLog::findOrFail(1)->value('current_deportation_group_id'); 
            
            
            $delegateController = new DelegateController($this);
            $storagePath = $delegateController->delegate_final_delivery_statement($delegate,$deportation_group_id);
            $statment = Statement::create([
                'delegate_id' => $delegate->id,
                'deportation_group_id' => $deportation_group_id,
                'pdf_path' => $storagePath
            ]);
            if (!$statment) 
            {
                throw new Exception('Can not create a new statement');
            }

            
            $shipments = $delegate->nonDeportedShipments();

            if ($shipments->isEmpty()) throw new Exception('This delegate does not have any shipment');

           // Group shipments by shop_id
            $shipmentsByShop = $shipments->groupBy('shop_id');
            
            foreach ($shipmentsByShop as $shopId => $shipments) 
            {
                try 
                {
                    
                    // Generate a unique bill number for the shop
                    // $billNumber = 'BILL-' . $shopId . '-' . time(); 
                    $billNumber = 'BILL-' . $shopId .'B'. $deportation_group_id;
                    // Alternatively, use Str::random(6) for a random string
                    // $billNumber = 'BILL-' . $shopId . '-' . Str::random(6);

                    $bill_tracking = BillTracking::firstOrCreate(
                        ['bill_number' => $billNumber],
                        [
                            'shop_id' => $shopId,
                            'bill_date' => now(),
                            'bill_status_id' => BillStatus::PENDING,
                            'deportation_group_id' => $deportation_group_id
                        ]
                    );
                
                    if (!$bill_tracking) throw new Exception('Can not create or find bill_tracking');
                    
                    $res_create_bills = $this->create_bills($shipments, $bill_tracking, $deportation_group_id);
                    
                    if ($res_create_bills['code'] != 1) 
                    {
                        throw new Exception($res_create_bills['msg']);
                    }
                    
                }
                catch(Exception $ex)
                { 
                    DB::rollBack();
                    return ['code' => 0 ,'msg' => $ex->getMessage()];
                }
                
            }
           
            //Add deportation process to deportation_logs table

           // check if it is the last deported report
           //then update deportation_group_id
            $res_handleDeportationLog = $this->handleDeportationLog($deportation_group_id);
            if ($res_handleDeportationLog['code'] != 1) 
            {
                throw new Exception($res_handleDeportationLog['msg']);
            }
            DB::commit();
            return ['code' => 1, 'data' => true];

        } 
        catch (Exception $ex) 
        {
            DB::rollBack();
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }


    private function create_bills($shipments, $billTracking, $deportationGroupId)
    {
        
        // $shipments->each(function ($shipment) use ($billTracking,$deportationGroupId) 
        // {
        foreach($shipments as $shipment)
        {
            try 
            {
                $res_get_delivery_price = (new DeliveryPriceService())->getDeliveryPrice($shipment->id);
                $res_get_delegate_delivery_price = (new CityDelegateService())->getDelegateDeliveryPrice($shipment->delegate_id,$shipment->consignee_city);

                if ($res_get_delivery_price['code'] != 1) 
                {
                    throw new Exception($res_get_delivery_price['msg']);
                }

                if ($res_get_delegate_delivery_price['code'] != 1) 
                {
                    throw new Exception($res_get_delegate_delivery_price['msg']);
                }
                
                $customer_delivery_price = $res_get_delivery_price['data'];
                $delegate_delivery_price = $res_get_delegate_delivery_price['data'];
                
                $profit = 0;
                if (in_array($shipment->shipment_status_id,[ShipmentStatus::DELIVERED,
                                                            ShipmentStatus::NO_RESPONSE,
                                                            ShipmentStatus::REJECTED_WITH_PAY,
                                                            ShipmentStatus::REJECTED_WITHOUT_PAY])) 
                {
                    $profit = $customer_delivery_price - $delegate_delivery_price;
                }
                else 
                {
                    $profit = 0;
                }
        
                $bill = Bill::create([
                    // 'bill_number' => $billNumber,
                    'shop_id' => $shipment->shop_id,
                    'delegate_id' => $shipment->delegate_id,
                    'consignee_name' => $shipment->consignee_name,
                    'consignee_phone' => $shipment->consignee_phone,
                    'consignee_city' => $shipment->consignee_city,
                    'consignee_region' => $shipment->consignee_region,
                    'order_price' => $shipment->order_price,
                    'value_on_delivery' => $shipment->value_on_delivery,
                    'customer_notes' => $shipment->customer_notes,
                    'delegate_notes' => $shipment->delegate_notes,
                    'is_returned' => $shipment->is_returned,
                    'shipment_status_id' => $shipment->shipment_status_id,
                    'customer_delivery_price' => $customer_delivery_price,
                    'delegate_delivery_price' => $delegate_delivery_price,
                    'profit' => $profit,
                    // 'bill_status_id' => BillStatus::PENDING,
                    'deportation_group_id' => $deportationGroupId,
                    'bill_tracking_id' => $billTracking->id
                ]);
                
                if (!$bill) throw new Exception('Error in storing new bill');
                
                if ($shipment->shipment_status_id != ShipmentStatus::POSTPONED) 
                {
                    $shipment->update(['is_deported' => true]);
                } 
                
                
            } 
            catch (Exception $ex) 
            {
                DB::rollBack(); 
                // return ['code' => 0 , 'msg' => $ex->getMessage()];
                dd($ex->getMessage());
            }
        // });
        }

        return ['code' => 1 , 'data' => true];
    }


    private function handleDeportationLog($deportationGroupId)
    {
        try 
        {
            $res_is_last_deported_report = $this->is_last_deported_report();

            if ($res_is_last_deported_report['code'] != 1) 
            {
                DB::rollBack();
                dd($res_is_last_deported_report['msg']);
            }
        
            $is_last_deported_report = $res_is_last_deported_report['data'];

            if ($is_last_deported_report) 
            { 
                //update bills status
                BillTracking::where('deportation_group_id', $deportationGroupId)
                            ->update(['bill_status_id' => BillStatus::UNDER_REVIEW]);

                LastDeportationLog::updateOrCreate(
                    ['id' => 1], 
                    ['current_deportation_group_id' => $deportationGroupId + 1, 'last_deporation_time' => now()]
                );
            }

            return ['code' => 1 , 'data' => true];
        }
        catch(Exception $ex)
        {
            DB::rollBack();
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

    public function get_total_summation(Delegate $delegate)
    {
        try 
        {
            $shipments = $delegate->nonDeportedShipments();
            $total_summation = 0;

            if ($shipments->isNotEmpty()) 
            {
                foreach ($shipments as $shipment) 
                {
                    $total_summation += $shipment->value_on_delivery;
                }

                return ['code' => 1, 'data' => $total_summation];
            }
            else 
            {
                return ['code' => 1, 'data' => 0];
            }
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }


    public function get_total_delegate_commission(Delegate $delegate)
    {
        try 
        {
            $shipments = $delegate->hasDelegateCommissionNonDeportedShipments();
            $total_commission = 0;

            if ($shipments->isNotEmpty()) 
            {
                foreach ($shipments as $shipment) 
                {
                    $total_commission += $delegate->cities()->where('city_id',$shipment->city->id)->first()->pivot->price;
                }
                
                return ['code' => 1, 'data' => $total_commission];
            }
            else 
            {
                return ['code' => 1, 'data' => 0];
            }
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }


    public function get_delegate_statements_ids(Delegate $delegate)
    {
        try 
        {
            $delegate_statements_ids = Bill::where('delegate_id', $delegate->id)
                                           ->pluck('deportation_group_id')
                                           ->unique()
                                           ->toArray();
                                           
            return ['code' => 1 , 'data' => $delegate_statements_ids];
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }

}
