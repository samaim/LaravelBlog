<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Fillable fields
    protected $fillable = [
        'name', 'email', 'password', 'is_admin',
    ];

    // Hidden fields
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Casts
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    // Check if user is an admin
    public function isAdmin()
    {
        return $this->is_admin;
    }
}
