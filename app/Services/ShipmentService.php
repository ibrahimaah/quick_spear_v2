<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Shipment;
use App\Models\ShipmentStatus;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ShipmentService
{
    public function store($data)
    { 
       try 
       {
            $shipment = Shipment::create($data);
            if ($shipment) 
            {
                return ['code' => 1 , 'data' => $shipment];
            }
            else 
            {
                return ['code' => 0 , 'msg' => 'Error in storing new shipment'];
            }
       }
       catch(Exception $ex)
       {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
       }
    }

    public function update(Request $request,Shipment $shipment,$by_admin=false)
    {
        try 
        { 
            
            $data = [ 
                'shop_id' => $request->shop,
                'consignee_name' => $request->consignee_name,
                'consignee_phone' => $request->consignee_phone,
                'consignee_phone_2' => $request->consignee_phone_2,
                'consignee_city' => $request->consignee_city,
                'consignee_region' => $request->consignee_region,
                'order_price' => $request->order_price,
                'customer_notes' => $request->customer_notes,
                'delegate_id' => $request->delegate ?? null,
                'delegate_notes' => $request->delegate_notes ?? null,
                'shipment_status_id' => $request->shipment_status_id,
                'is_returned' => $request->is_returned ?? 0,
            ];

            
            if($shipment->shipment_status_id == ShipmentStatus::UNDER_REVIEW && $request->shipment_status_id == ShipmentStatus::UNDER_DELIVERY)
            {
                $data['accepted_by_admin_at'] = Carbon::now()->toDateTimeString();
            }

            if ($by_admin) 
            {
                $data['value_on_delivery'] = $request->value_on_delivery ?? 0; 
            }

            if ($shipment->update($data)) 
            {
                return ['code' => 1, 'data' => true ];
            }
            else 
            {
                throw new Exception('Error in updating shipment');
            }
            ///////////////////////////////////////////////////////////
        }
        catch(Exception $ex)
        {
            return ['code'=>0,'msg'=>$ex->getMessage()];
        }
    }
    //assign delegate to shipments
    public function assign_delegate($delegate_id, $shipments_ids)
    {
        try 
        {
            $affectedRows = Shipment::whereIn('id', $shipments_ids)->update(['delegate_id' => $delegate_id]);
            if ($affectedRows > 0) 
            {
                return ['code' => 1, 'data' => true];
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

    public function remove($id)
    {
        try 
        {
            $shipment = Shipment::findOrFail($id);
            
            if ($shipment->delete()) 
            {
                return ['code' => 1, 'data' => true];
            } 
            else 
            {
                throw new Exception('Error in deleting shipment');
            }
        } 
        catch (Exception $ex) 
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

    public function cancel_assign_delegate($id)
    {
        try 
        {
            $shipment = Shipment::findOrFail($id);
            $shipment->delegate_id = null;
            if ($shipment->save()) 
            {
                return ['code' => 1, 'data' => true];
            }
            else 
            {
                throw new Exception('Error in cancel assign');   
            }
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }


    public function get_selected_shipments($ids)
    {
        try 
        {
            $shipments = Shipment::whereIn('id', $ids)->get();
            
            if ($shipments->isNotEmpty()) 
            {
                return ['code' => 1, 'data' => $shipments];
            }
            else 
            {
                throw new Exception('Error in getting selected shipments');   
            }
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

    public function update_status(Shipment $shipment,$shipment_status_id)
    {
        try 
        { 
            $shipment->shipment_status_id = $shipment_status_id;
            if ($shipment->save()) 
            {
                return ['code' => 1 , 'data' => true];
            }
            else 
            {
                throw new Exception('Can not update shipment status');
            }
        } 
        catch (Exception $ex) 
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }


    

  
}
