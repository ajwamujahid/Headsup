<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'interest',
        'notes',
        'process',
        'disposition',
        'salesperson_id',
        'assigned_to',
    ];
    
    public function salesperson()
    {
        return $this->belongsTo(SalesProfile::class, 'assigned_to', 'id');
    }
    

    
    public function transferredTo()
    {
        return $this->belongsTo(SalesProfile::class, 'transferred_to');
    }
}
