<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'national_id', 'vehicle_no', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'national_id', 'national_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_no', 'vehicle_no');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }
}





    