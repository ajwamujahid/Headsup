<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Customer;

class SalespersonHighlighted implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $customerId;
    public $salespersonName;

    public function __construct($customerId)
    {
        $this->customerId = $customerId;
    
        $customer = Customer::with('salesperson')->find($customerId);
        $this->salespersonName = $customer?->salesperson?->name ?? 'Unknown';
    }
    

    public function broadcastOn()
    {
        return new Channel('queue-highlights');
    }

    public function broadcastWith()
    {
        return [
            'customerId' => $this->customerId,
            'salespersonName' => $this->salespersonName
        ];
    }
}
