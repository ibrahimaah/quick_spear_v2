<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillStatus extends Model
{
    use HasFactory;

    protected $table = 'bill_statuses';

    const UNDER_REVIEW = 1;
    const Payment_Made = 2;
    const CANCELED = 3; 

}
