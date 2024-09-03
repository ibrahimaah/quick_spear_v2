<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Shop;
use App\Services\BillService;
use Exception;
use Illuminate\Http\Request;
use PDF;

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
            
            $shop = Shop::findOrFail(get_shop_id_from_bill_number($bill_number)); 

            $client_name = $shop->user->name;

            $bill_date_day = get_arabic_day_from_bill_number($bill_number);

            $bill_date = get_date_from_bill_number($bill_number);

            $orders = Bill::where('bill_number',$bill_number)->get();
            
            $pdf = PDF::loadView('admin.transactions.bill',
                                [
                                'orders'     => $orders,
                                'shop'  => $shop,
                                'client_name'=> $client_name,
                                'bill_date_day' => $bill_date_day,
                                'bill_date' => $bill_date,
                                ]);
            return $pdf->stream('bill-'.$bill_number.'.pdf');
       }
       catch(Exception $ex)
       {
            dd($ex->getMessage());
       }
        
    }
}
