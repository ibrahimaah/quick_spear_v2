<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Services\BillService;
use Illuminate\Http\Request;

class BillController extends Controller
{

    public function __construct(private BillService $billService)
    {
        
    }
    
    public function view_shop_bills(Shop $shop)
    {
        $res_get_bills_by_shop_id = $this->billService->get_bills_by_shop_id($shop->id);

        if ($res_get_bills_by_shop_id['code'] == 1) 
        {
            $shop_bills = $res_get_bills_by_shop_id['data'];
            // dd($shop_bills);
            return view('admin.transactions.shop_bills',compact('shop_bills'));
        }
        else 
        {
            dd($res_get_bills_by_shop_id);
        }
    }
}
