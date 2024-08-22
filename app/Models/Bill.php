<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $primaryKey = 'bill_id';

    protected $fillable = [
        'total_amount',
        'pay_id',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'pay_id', 'pay_id');
    }
}