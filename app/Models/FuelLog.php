<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelLog extends Model
{
    protected $fillable = [
        'vehicle_id',
        'odometer',
        'date',
        'liters',
        'price_per_liter',
        'total_cost',
        'is_fuel_tank',
        'notes',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
