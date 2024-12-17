<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Services\BillService;
use Illuminate\Http\Request;

class BillController extends Controller
{

    public function __construct(private BillService $billService)
    {
        
    }


    public function view_shop_bills(Shop $shop,$bill_status_id=null)
    {
        // $res_get_bills_by_shop_id = $this->billService->get_bills_by_shop_id_and_bill_status($shop->id,$bill_status_id);
        $res_get_bills_by_shop_id = $this->billService->get_bills_by_shop_id_and_bill_status($shop->id,$bill_status_id);
        $res_get_total_due_to_customer_amount = $this->billService->get_total_due_to_customer_amount($shop->id);

        if ($res_get_total_due_to_customer_amount['code'] == 0) 
        {
             dd($res_get_total_due_to_customer_amount['msg']);
        }
        if ($res_get_bills_by_shop_id['code'] == 0) 
        {
             dd($res_get_bills_by_shop_id['msg']);
        }

        
        $shop_bills = $res_get_bills_by_shop_id['data']; 
        $total_due_to_customer_amount = $res_get_total_due_to_customer_amount['data'];
        return view('pages.user.bills.index',compact(['shop_bills','shop','total_due_to_customer_amount']));
    
    }

    public function prepare_bill($bill_number)
    {
       $res_prepare_bill = $this->billService->prepare_bill($bill_number);
       
       if ($res_prepare_bill['code'] == 0) 
       {
            dd($res_prepare_bill['msg']);
       }
      
    }
}
