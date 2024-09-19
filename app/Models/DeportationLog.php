<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeportationLog extends Model
{
    use HasFactory;
    protected $table = 'deportation_logs'; // Your table name

    protected $fillable = ['last_deported_report_date']; // Allow mass assignment for this field
}
