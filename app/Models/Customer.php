<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'salesperson_id', 'name', 'email', 'phone', 'note', 'assigned_to', 
        'transferred', 'transferred_to', 'interest', 'notes', 'process', 'disposition'
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
