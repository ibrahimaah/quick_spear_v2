<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Statement;
use App\Services\ProfitService;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    public function __construct(private ProfitService $profitService)
    {
        
    }

    public function profits() 
    {
        return view ('admin.profits.index');
    }

    public function calc_profits(Request $request)
    {
        $validated = $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);


        $from = $validated['from'];
        $to   = $validated['to']; 

        $res_calc_profits_by_date = $this->profitService->calc_profits_by_date($from,$to);

        if ($res_calc_profits_by_date['code'] != 1) 
        {
            dd($res_calc_profits_by_date['msg']);
        }

        return view('admin.profits.index', [
            'profits' => $res_calc_profits_by_date['data'],
            'from' => $from,
            'to' => $to
        ]);
    }
    public function profits_details($from , $to)
    {
        $res_get_profits_details = $this->profitService->get_profits_details($from,$to);
        if ($res_get_profits_details['code'] != 1) 
        {
            dd($res_get_profits_details['msg']);
        }

        $statementsGroupedByDelegate = $res_get_profits_details['data'];

        return view('admin.profits.profits-details', [
            'statementsGroupedByDelegate' => $statementsGroupedByDelegate,
            'from' => $from,
            'to' => $to
        ]);
    }
}
