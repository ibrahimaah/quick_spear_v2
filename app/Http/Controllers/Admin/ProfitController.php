<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
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
        ]);
    }
}
