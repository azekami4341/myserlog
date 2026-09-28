<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaintenanceRecord extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'maintenance_item_id',
        'date',
        'odometer',
        'cost',
        'notes',
    ];

    public function maintenanceItem()
    {
        return $this->belongsTo(MaintenanceItem::class);
    }
}