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
        $statements = Statement::whereBetween('created_at', [$from, $to])->with('delegate')->get();
        $statementsGroupedByDelegate = $statements->groupBy('delegate_id');
        // dd($statementsGroupedByDelegate);

          // Calculate profits for each statement
        foreach ($statementsGroupedByDelegate as $delegateId => $statements) {
            foreach ($statements as $statement) {
                $profitService = new ProfitService();
                $result = $profitService->calc_profits_by_statement_id_and_date($statement->id, $from, $to);
                if ($result['code'] != 1) {
                    // Handle the error
                    dd($result['msg']); 
                    // session()->flash('error', $result['msg']);
                    // break;
                }
                $statement->calculated_profit = $result['data']; // Add the calculated profit to the statement
            }
        }


        return view('admin.profits.profits-details', [
            'statementsGroupedByDelegate' => $statementsGroupedByDelegate,
            'from' => $from,
            'to' => $to
        ]);
    }
}
