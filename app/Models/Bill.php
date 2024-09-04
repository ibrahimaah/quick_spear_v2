<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'customer_delivery_price',
        'shipment_status_id',
        'bill_status_id'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class,'consignee_city','id');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class,'consignee_region','id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(ShipmentStatus::class, 'shipment_status_id', 'id');
    }

}
