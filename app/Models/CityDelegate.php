<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityDelegate extends Model
{
    use HasFactory;

    protected $table = 'city_delegate';

    protected $fillable = ['city_id', 'delegate_id', 'price'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function delegate()
    {
        return $this->belongsTo(Delegate::class);
    }
    
}
