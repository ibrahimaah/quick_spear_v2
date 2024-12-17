<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillStatus;
use App\Models\BillTracking;
use App\Models\Shop;
use App\Services\BillService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use PDF;

class BillController extends Controller
{

    public function __construct(private BillService $billService)
    {
        
    }
    
    public function view_shop_bills(Shop $shop,$bill_status_id)
    {
        // $res_get_bills_by_shop_id = $this->billService->get_bills_by_shop_id_and_bill_status($shop->id,$bill_status_id);
        $res_get_bills_by_shop_id = $this->billService->get_bills_by_shop_id_and_bill_status($shop->id,$bill_status_id);

        if ($res_get_bills_by_shop_id['code'] == 1) 
        {
            $shop_bills = $res_get_bills_by_shop_id['data']; 
            // dd($shop_bills);
            return view('admin.transactions.shop_bills',compact(['shop_bills','shop']));
        }
        else 
        {
            dd($res_get_bills_by_shop_id);
        }
    }

    // public function prepare_bill(Request $request)
    public function prepare_bill($bill_number)
    {
       $res_prepare_bill = $this->billService->prepare_bill($bill_number);
       if ($res_prepare_bill['code'] == 0) 
       {
            dd($res_prepare_bill['msg']);
       }
    }

    public function pay_bill(Request $request)
    {
        //bill_number
        $validated = $request->validate([ 
            'bill_number' => 'required',
        ]);

        $bill_number = $validated['bill_number'];

        $res_update_bill_status = $this->billService->update_bill_status($bill_number,BillStatus::Payment_Made);
        if ($res_update_bill_status['code'] == 1) {
            return redirect()->back()->with("success","تمت العملية بنجاح");
        }
        else{
            dd($res_update_bill_status['msg']);
        }
    }

    public function delete_bill($bill_number)
    {
        $res_remove = $this->billService->remove($bill_number);
        if ($res_remove['code'] ==1 ) 
        {
            return back()->with('success',"تمت العملية بنجاح");
        }
        else 
        {
            dd($res_remove['msg']);
        }
    }
}
