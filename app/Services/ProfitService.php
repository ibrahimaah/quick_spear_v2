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
}