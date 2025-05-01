<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nip', 'full_name', 'gender', 'birth_place', 'birth_date', 'religion', 
        'phone', 'email', 'address', 'status', 'photo', 'position', 'subject', 
        'password', 'level'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
