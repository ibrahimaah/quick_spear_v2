<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ExpressDataTable;
use App\Http\Controllers\Controller;
use App\Models\ReturnStatus;
use App\Models\Shipment;
use App\Services\ShipmentReturnService;
use Exception;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function __construct(private ShipmentReturnService $shipmentReturnService)
    {
        
    }


    public function get_returns()
    {
        $dataTable = new ExpressDataTable(false,null,null,true);
        return $dataTable->render('admin.returns.index');
    }

    public function delete_return(Shipment $shipment)
    {
        $shipment->return_status_id = ReturnStatus::DELETED;
        $shipment->save();
        return back()->with('success','تم الحذف بنجاح');
    }

    public function update_return_status(Shipment $shipment , $shipment_return_status_id)
    {
        try 
        {
            $shipment->return_status_id = $shipment_return_status_id;
            $shipment->save();
            return response()->json(['code' => 1 , 'data' => true]);
        }
        catch(Exception $ex)
        {
            return response()->json(['code' => 0 , 'msg' => $res_update_status['msg']]);
        }
    }
}
