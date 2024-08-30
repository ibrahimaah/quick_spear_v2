<?php

namespace App\Services;

use App\Models\Shop;
use Exception;
use Illuminate\Support\Facades\Auth;

class ShopService
{

    public function get_all_shops()
    {
        try 
        {
            $shops = Shop::all();
            return ['code' => 1, 'data' => $shops];
        } 
        catch (Exception $ex) 
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

    public function store($data)
    {
        try 
        {
            $user = Shop::Create($data);

            if ($user) 
            { 
                return ['code' => 1, 'data' => $user];
            } 
            else 
            {
                throw new Exception('Error store user');
            }
        } 
        catch (Exception $ex) 
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }
}