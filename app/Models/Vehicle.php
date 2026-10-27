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
        'license_plate',
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

    public function calculateLatestFuelEfficiency(): ?float
    {
        $fullTanks = $this->fuelLogs()
            ->where('is_full_tank', true)
            ->orderByDesc('odometer')
            ->take(2)
            ->get();

        if ($fullTanks->count() < 2) {
            return null;
        }

        $latestFull = $fullTanks[0];
        $previousFull = $fullTanks[1];

        $distance = $latestFull->odometer - $previousFull->odometer;

        $litersUsed = $this->fuelLogs()
            ->where('odometer', '>', $previousFull->odometer)
            ->where('odometer', '<=', $latestFull->odometer)
            ->sum('liters');

        if ($distance <= 0 || $litersUsed <= 0) {
            return null;
        }

        return round($distance / $litersUsed, 2);
    }

    public function calculateOverallFuelEfficiency(): ?float
    {
        $firstFull = $this->fuelLogs()
            ->where('is_full_tank', true)
            ->orderBy('odometer')
            ->first();

        $latestFull = $this->fuelLogs()
            ->where('is_full_tank', true)
            ->orderByDesc('odometer')
            ->first();

        if (!$firstFull || !$latestFull || $firstFull->is($latestFull)) {
            return null;
        }

        $distance = $latestFull->odometer - $firstFull->odometer;

        $litersUsed = $this->fuelLogs()
            ->where('odometer', '>', $firstFull->odometer)
            ->where('odometer', '<=', $latestFull->odometer)
            ->sum('liters');

        if ($distance <= 0 || $litersUsed <= 0) {
            return null;
        }

        return round($distance / $litersUsed, 2);
    }
}
