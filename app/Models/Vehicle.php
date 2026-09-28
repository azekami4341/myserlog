<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'name',
        'brand',
        'model',
        'year',
        'licence_plate',
        'initial_odometer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function odometerLogs()
    {
        return $this->hasMany(OdometerLog::class);
    }

    public function fuelLogs()
    {
        return $this->hasMany(FuelLog::class);
    }

    public function maintenanceItems()
    {
        return $this->hasMany(MaintenanceItem::class);
    }
}
