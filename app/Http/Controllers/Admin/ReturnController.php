<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ExpressDataTable;
use App\Http\Controllers\Controller;
use App\Models\ReturnStatus;
use App\Models\Shipment;
use App\Services\ShipmentReturnService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use PDF;

class ReturnController extends Controller
{
    public function __construct(private ShipmentReturnService $shipmentReturnService)
    {
        
    }

    private function generateReturnsPDF($view, $data)
    { 
        // Generate the PDF
        $pdf = PDF::loadView($view, $data);
        $now = Carbon::now();
        $pdf_file_name = $view . '_' . $now->format('Y-m-d') . '_' . floor(time() - 999999999);

        return response()->streamDownload(function() use ($pdf) 
        {
            echo $pdf->output();
        }, 
        $pdf_file_name . '.pdf', [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $pdf_file_name . '.pdf"'
        ]);
    }
 
    public function view_returns_as_pdf()
    { 
        $returns_shipments = Shipment::where(function ($query) {
            $query->whereIn('shipment_status_id', [ReturnStatus::UNDER_REVIEW,ReturnStatus::NOT_RECEIVED_FROM_DELEGATE])
                    ->orWhere('is_returned', true);
            })
            ->where('is_deported',true)
            ->where('return_status_id','<>',ReturnStatus::DELETED)
            ->orderBy('id','DESC')->get();

          
        return $this->generateReturnsPDF('admin.returns.returns_pdf', ['shipments' => $returns_shipments]);
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
            return response()->json(['code' => 0 , 'msg' => 'Error']);
        }
    }
}
