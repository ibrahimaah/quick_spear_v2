<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BillService;
use Illuminate\Http\Request;

class BillController extends Controller
{

    public function __construct(private BillService $billService)
    {
        
    }
    
    public function view_shop_bills($shop_id)
    {
        $res_get_bills_by_shop_id = $this->billService->get_bills_by_shop_id($shop_id);

        if ($res_get_bills_by_shop_id['code'] == 1) 
        {
            return view('admin.transactions.shop_bills');
        }
    }
}
