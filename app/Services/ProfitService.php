<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Statement;
use Exception;

class ProfitService
{
    public function calc_profits_by_date($from ,$to)
    {
        try 
        {
            $profits = Bill::whereBetween('created_at', [$from, $to])->sum('profit');
            return ['code' => 1 , 'data' => $profits];   
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }

    public function calc_profits_by_statement_id_and_date($statement_id,$from ,$to)
    {
        try 
        {
            $statement = Statement::findOrFail($statement_id);
            $profits = Bill::where('delegate_id',$statement->delegate_id)
                           ->where('deportation_group_id',$statement->deportation_group_id)
                           ->whereBetween('created_at', [$from, $to])
                           ->sum('profit');

            return ['code' => 1 , 'data' => $profits];   
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }

    public function get_profits_details($from,$to)
    {
        try 
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
            return ['code' => 1 , 'data' => $statementsGroupedByDelegate];
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }
}