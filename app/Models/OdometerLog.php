<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OdometerLog extends Model
{
    protected $fillable = [
        'vehicle_id',
        'odometer',
        'date',
        'source_type',
        'source_id',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
