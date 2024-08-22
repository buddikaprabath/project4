<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldVehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_no', 'vehicle_name', 'model', 'type', 'chassis_no', 'engine_no', 'yom', 'v_status', 'buying', 'selling',
    ];
}