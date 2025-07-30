<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
    protected $fillable = [
        'salesperson_id', 'name', 'email', 'phone', 'note', 'assigned_to', 
        'transferred', 'transferred_to', 'interest', 'notes', 'process', 'disposition'
    ];

    protected $casts = [
        'process' => 'array',
    ];

    public function salesperson()
    {
        return $this->belongsTo(SalesProfile::class, 'salesperson_id', 'id');
    }

    // Optional if you need these
    public function assignedTo()
    {
        return $this->belongsTo(SalesProfile::class, 'assigned_to', 'id');
    }

    public function transferredTo()
    {
        return $this->belongsTo(SalesProfile::class, 'transferred_to', 'id');
    }
}
