<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'national_id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'national_id',
        'customer_address',
        'customer_phone',
        'ctype'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ["user", "admin"][$value],
        );
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'national_id', 'national_id');
    }

    public function messages()
{
    return $this->hasMany(Message::class, 'cus_id', 'national_id');
}
}