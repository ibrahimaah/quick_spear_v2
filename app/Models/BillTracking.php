<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillTracking extends Model
{
    use HasFactory;

    protected $table = "bills_tracking";

    protected $fillable = [
        'shop_id',
        'bill_number',
        'bill_status_id',
        'bill_date',
        'deportation_group_id'
    ];

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function billStatus()
    {
        // Specify the foreign key in the `bills_tracking` table and the primary key in the `bill_statuses` table
        return $this->belongsTo(BillStatus::class, 'bill_status_id', 'id');
    }

    public function shop()
    {
        // Specify the foreign key in the `bills_tracking` table and the primary key in the `bill_statuses` table
        return $this->belongsTo(Shop::class);
    }
}
