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
        $from = $request->from;
        $to = $request->to;

        $profits = Bill::whereBetween('created_at', [$from, $to])->sum('profit');

        return view('admin.profits.index', [
            'profits' => $profits,
            'from' => $from,
            'to' => $to
        ]);
    }
    public function profits_details($from , $to)
    {
        $statements = Statement::whereBetween('created_at', [$from, $to])->with('delegate')->get();
        $statementsGroupedByDelegate = $statements->groupBy('delegate_id');
        // dd($statementsGroupedByDelegate);
        return view('admin.profits.profits-details', [
            'statementsGroupedByDelegate' => $statementsGroupedByDelegate,
            'from' => $from,
            'to' => $to
        ]);
    }
}
