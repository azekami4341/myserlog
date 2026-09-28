<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'vehicle_id',
        'name',
        'interval_km',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
