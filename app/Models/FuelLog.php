<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuelLog extends Model
{
    use HasFactory;
    
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
