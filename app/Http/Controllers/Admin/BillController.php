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
        
       try 
       {
            // $validated = $request->validate([
            //     'bill_number' => 'required'
            // ]);

            // $bill_number = $validated['bill_number'];
            $bill_tracking = BillTracking::where('bill_number',$bill_number)->firstOrFail();

            $shop = $bill_tracking->shop; 

            $client_name = $shop->user->name;

            $bill_date_day = get_arabic_day_from_bill_number($bill_number);

            $bill_date =Carbon::parse($bill_tracking->bill_date)->format('Y-m-d');

            $orders = $bill_tracking->bills;
             

            $res_get_amount_due_from_and_to_customer = $this->billService->get_amount_due_from_and_to_customer($orders);
            
            if ($res_get_amount_due_from_and_to_customer['code'] == 0) 
            {
                dd($res_get_amount_due_from_and_to_customer['msg']);
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
                'total_due_from_customer_amount'
            ));
            
            return $pdf->stream('bill-'.$bill_number.'.pdf');
       }
       catch(Exception $ex)
       {
            dd($ex->getMessage());
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
