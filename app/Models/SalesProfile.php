<?php
// app/Models/SalesProfile.php

namespace App\Models;
use App\Models\Customer;

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
    public function customers()
    {
        return $this->hasMany(Customer::class, 'salesperson_id');
    }
   // In SalesProfile.php
public function activeCheckin()
{
    return $this->hasOne(SalesCheckin::class, 'salesperson_id')
                ->whereNull('check_out_time');
}
  
}
