<?php

namespace App\Services;

use App\Models\Bill;
use Exception;
use Illuminate\Support\Facades\Auth;

class BillService
{
    public function get_bills_by_shop_id($shop_id)
    {
        try 
        {
            $shop_bills = Bill::where('shop_id',$shop_id)->get();

            return ['code' => 1, 'data' => $shop_bills];
        } 
        catch (Exception $ex) 
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }
}