<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'phone',
        'date',
        'time',
        'salesperson_id',
        'notes'
    ];
    protected $attributes = [
        'status' => 'scheduled',
    ];
    
    public function salesperson()
    {
        return $this->belongsTo(SalesProfile::class, 'salesperson_id');
    }
}
