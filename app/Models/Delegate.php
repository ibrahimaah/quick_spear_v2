<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Delegate extends Model
{
    use HasFactory;

    protected $fillable = ['name','phone','city_id'];

    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }

    public function statements(): HasMany
    {
        return $this->hasMany(Statement::class);
    }

    // public function cities(): HasMany
    // {
    //     return $this->hasMany(City::class);
    // }

    // public function City()
    // {
    //     return $this->belongsTo(City::class);
    // }

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class)->withPivot('price')->withTimestamps();
    }

    public function cityDelegates()
    {
        return $this->hasMany(CityDelegate::class);
    }
    
    public function nonDeportedShipments()
    {
        return $this->shipments()->nonDeported()->get();
        // return $this->shipments()
        //             ->nonDeported()
        //             ->join('cities', 'shipments.consignee_city', '=', 'cities.id')
        //             ->select('shipments.*')
        //             ->orderBy('cities.name')
        //             ->get();

    }

    public function deportedShipments()
    {
        return $this->shipments()->deported()->get();
    }

    public function hasDelegateCommissionNonDeportedShipments()
    {
        return $this->shipments()->nonDeported()->hasDelegateCommission()->get();
    }



   
}
