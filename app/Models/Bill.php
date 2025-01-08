<?php

namespace App\Models;

use Exception;
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
        'delegate_delivery_price',
        'profit',
        'shipment_status_id',
        'deportation_group_id',
        'bill_tracking_id'
        // 'deportation_log_id'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class,'consignee_city','id');
    }

    public function bill_tracking(): BelongsTo
    {
        return $this->belongsTo(BillTracking::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class,'consignee_region','id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(ShipmentStatus::class, 'shipment_status_id', 'id');
    }

    public function delegate()
    {
        return $this->belongsTo(Delegate::class);
    }
    // public function is_bill_status_under_review($bill_number)
    // {
    //     try 
    //     {
    //         if ($this->bill_status_id == BillStatus::UNDER_REVIEW) 
    //         {
    //             return true;
    //         }
    //         else 
    //         {
    //             return false;
    //         }
    //     }
    //     catch(Exception $ex)
    //     {
    //         dd($ex->getMessage());
    //     }
    // }

    // public function is_bill_status_payment_made($bill_number)
    // {
    //     try 
    //     {
    //         if ($this->bill_status_id == BillStatus::Payment_Made) 
    //         {
    //             return true;
    //         }
    //         else 
    //         {
    //             return false;
    //         }
    //     }
    //     catch(Exception $ex)
    //     {
    //         dd($ex->getMessage());
    //     }
    // }

}
