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

    public function update(Array $data,Shipment $shipment,$by_admin=false)
    {
        try 
        { 
        
            if ($by_admin) 
            {
                $data['value_on_delivery'] = $data['value_on_delivery'] ?? 0; 
                
                if($shipment->shipment_status_id == ShipmentStatus::UNDER_REVIEW && 
                   $data['shipment_status_id'] == ShipmentStatus::UNDER_DELIVERY)
                {
                    $data['accepted_by_admin_at'] = Carbon::now()->toDateTimeString();
                }
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

    public function update_status(Shipment $shipment,$shipment_status_id ,$with_value_on_delivery = false)
    {
        try 
        { 
            $shipment->shipment_status_id = $shipment_status_id;
            if ($with_value_on_delivery) 
            {
                switch($shipment_status_id)
                {
                    // case ShipmentStatus::REJECTED_WITH_PAY:
                    case ShipmentStatus::DELIVERED:
                        $shipment->value_on_delivery = $shipment->order_price;
                        break;
                    default:
                        // Default case if no other case matches
                        $shipment->value_on_delivery = 0; // Example default action
                    break;
                }
            }


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
