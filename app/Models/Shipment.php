<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipment extends Model
{
    protected $fillable = [
        'shop_id',
        'delegate_id',
        'consignee_name',
        'consignee_phone',
        'consignee_phone_2',
        'consignee_city',
        'consignee_region',
        'consignee_zip_code', 
        'accepted_by_admin_at', 
        'order_price',
        'value_on_delivery',
        'customer_notes',
        'delegate_notes',
        'is_returned',
        'is_deported',
        'shipment_status_id'
    ];
    protected $appends = ['notes'];

    public function getNotesAttribute()
    {
        if ($this->customer_notes && $this->delegate_notes) 
            {
                return $this->customer_notes .' - '.$this->delegate_notes;
            }
            elseif ($this->customer_notes && !$this->delegate_notes) 
            {
                return $this->customer_notes;
            }
            elseif (!$this->customer_notes && $this->delegate_notes) 
            {
                return $this->delegate_notes;
            }
            else 
            {
                return 'لا يوجد';
            }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function city_to()
    {
        return $this->belongsTo(City::class, 'consignee_city');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    // public function get_status()
    // {
    //     $status = $this->status;
    //     switch ($status) {
    //         case 0:
    //             $statusMsg = 'New';
    //             break;

    //         case 1:
    //             $statusMsg = 'Processing';
    //             break;

    //         case 2:
    //             $statusMsg = 'Delivered';
    //             break;

    //         case 3:
    //             $statusMsg = 'Returned';
    //             break;

    //         case 4:
    //             $statusMsg = 'Pending Payments';
    //             break;
    //         case 5:
    //             $statusMsg = 'Payment Successfully';
    //             break;

    //         default:
    //             $statusMsg = 'Draft';
    //             break;
    //     }
    //     return $statusMsg;
    // }

    public function get_status()
    {
        $status = $this->status;
        $status_numbers = config('constants.STATUS_NUMBER');
        switch ($status) {
            case $status_numbers['UNDER_REVIEW']:
                return __('under_review');
            case $status_numbers['UNDER_DELIVERY']:
                return __('under_delivery');
            case $status_numbers['DELIVERED']:
                return __('delivered');
            case $status_numbers['REJECTED_WITHOUT_PAY']:
                return __('rejected_without_pay');
            case $status_numbers['REJECTED_WITH_PAY']:
                return __('rejected_with_pay');
            case $status_numbers['POSTPONED']:
                return __('postponed');
            case  $status_numbers['NO_RESPONSE']:
                return __('no_response');
            // case $status_numbers['RETURNED']:
            //     return __('returned');
            default:
                return __('unknown_status');
        }
    }

    public function delegate(): BelongsTo
    {
        return $this->belongsTo(Delegate::class);
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

    // public function scopeIsDeported($query)
    // {
    //     return $query->where('is_deported',true);
    // }

    // public function scopeIsNotDeported($query)
    // {
    //     return $query->where('is_deported',false);
    // }

    public function scopeNonDeported($query)
    {
        return $query->where('is_deported', false);
    }

    public function scopeDeported($query)
    {
        return $query->where('is_deported', true);
    }

    // public function scopeUnProfitable($query)
    // {
    //     return $query->whereIn('shipment_status_id', [
    //         ShipmentStatus::POSTPONED,
    //         ShipmentStatus::NO_RESPONSE,
    //         ShipmentStatus::UNDER_REVIEW,
    //         ShipmentStatus::UNDER_DELIVERY,
    //         ShipmentStatus::CANCELED
    //     ]);
    // }

    public function scopeHasDelegateCommission($query)
    {
        return $query->whereIn('shipment_status_id', 
        [ 
            ShipmentStatus::NO_RESPONSE, 
            ShipmentStatus::DELIVERED, 
            ShipmentStatus::REJECTED_WITHOUT_PAY, 
            ShipmentStatus::REJECTED_WITH_PAY
        ]);
    }
}
