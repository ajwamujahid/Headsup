<?php
// app/Models/SalesProfile.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
    ];

    // optional: hide password from being exposed
    protected $hidden = [
        'password',
    ];
}
