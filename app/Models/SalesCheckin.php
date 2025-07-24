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
        'is_current_turn',
        'last_assigned_at',
        'pending_customers_count',
        'transferred_customers', // ✅ Add this field (as discussed)
    ];

    protected $casts = [
        'is_current_turn' => 'boolean',
        'has_taken_customer' => 'boolean',
        'last_assigned_at' => 'datetime',
    ];

    protected $dates = [
        'check_in_time',
        'check_out_time',
    ];

    // Relationship with SalesProfile
    public function salesperson()
    {
        return $this->belongsTo(\App\Models\SalesProfile::class, 'salesperson_id');
    }
}
