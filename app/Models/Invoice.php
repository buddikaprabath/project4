<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'national_id',
        'vehicle_no',
        'total_amount',
        'total_bill_amount',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'national_id', 'national_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_no', 'vehicle_no');
    }
}