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

        if ($res_get_bills_by_shop_id['code'] == 1) 
        {
            $shop_bills = $res_get_bills_by_shop_id['data']; 
            // dd($shop_bills);
            return view('pages.user.bills.index',compact(['shop_bills','shop']));
        }
        else 
        {
            dd($res_get_bills_by_shop_id);
        }
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
