<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class DeliveryPriceController extends Controller
{
    public function view_delivery_prices(Shop $shop)
    {
        return view('pages.user.delivery_prices.index',['shop' => $shop]);
    }
}
