<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProfitService; 

class ProfitController extends Controller
{
    public function __construct(private ProfitService $profitService)
    {
        
    }

    public function profits() 
    {
        return view ('admin.profits.index');
    }
}
