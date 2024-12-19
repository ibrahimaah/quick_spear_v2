<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnStatus extends Model
{
    use HasFactory;

    protected $table = 'return_statuses';

    const NOT_RECEIVED_FROM_DELEGATE = 1;
    const RECEIVED_FROM_DELEGATE = 2;
    const DELIVERED_TO_THE_SHOP = 3;
    const DELETED = 4; 
    const UNDER_REVIEW = 5; 
}
