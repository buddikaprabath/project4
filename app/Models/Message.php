<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'status',
        'cus_id',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'cus_id', 'national_id');
    }
}