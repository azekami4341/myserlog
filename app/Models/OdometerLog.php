<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OdometerLog extends Model
{
    use HasFactory;

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
