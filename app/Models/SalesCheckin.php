<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SalesCheckin extends Model
{
    protected $fillable = [
        'salesperson_id',
        'check_in_time',
        'check_out_time',
        'duration',
        'has_taken_customer',
        'is_current_turn', // 🔥 Add this!
        'last_assigned_at',
    ];
    protected $casts = [
        'is_current_turn' => 'boolean',
    ];
        

    protected $dates = [
        'check_in_time',
        'check_out_time',
    ];
    // app/Models/SalesCheckin.php

public function salesperson()
{
    return $this->belongsTo(\App\Models\SalesProfile::class, 'salesperson_id');
}

    

}
