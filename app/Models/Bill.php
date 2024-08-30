<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_number',
        'shop_id',
        'delegate_id',
        'consignee_name',
        'consignee_phone', 
        'consignee_city',
        'consignee_region', 
        'order_price',
        'value_on_delivery',
        'customer_notes',
        'delegate_notes',
        'is_returned', 
        'shipment_status_id',
        'bill_status_id'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

}
