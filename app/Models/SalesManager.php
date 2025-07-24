<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // 👈 So we can use auth features
use Illuminate\Notifications\Notifiable;

class SalesManager extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'sales_managers'; // 👈 Table name

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
