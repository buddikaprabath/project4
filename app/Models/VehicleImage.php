<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_no',
        'image_path',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_no', 'vehicle_no');
    }
}