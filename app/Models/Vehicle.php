<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $primaryKey = 'vehicle_no';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'vehicle_no',
        'vehicle_name',
        'model',
        'type',
        'chassis_no',
        'engine_no',
        'yom',
        'v_status',
        'order_status',
        'advancepayment',
        'buying',
        'selling',

    ];

    public function images()
    {
        return $this->hasMany(VehicleImage::class, 'vehicle_no', 'vehicle_no');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'vehicle_no', 'vehicle_no');
    }

    
}