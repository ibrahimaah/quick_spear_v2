<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    use HasFactory;
    protected $fillable = ['delegate_id','deportation_group_id','pdf_path','final_total','delegate_profits'];
    public function delegate()
    {
        return $this->belongsTo(Delegate::class);
    }
}
