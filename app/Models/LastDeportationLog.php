<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastDeportationLog extends Model
{
    use HasFactory;

    protected $table = 'last_deportation_logs'; // Your table name

    protected $fillable = ['last_deporation_time','current_deportation_group_id']; // Allow mass assignment for this field

}
