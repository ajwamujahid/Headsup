<?php
namespace App\Events;

use App\Models\Customer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class CustomerTransferred implements ShouldBroadcast
{
    use SerializesModels;

    public $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function broadcastOn()
    {
        return new Channel('customers');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->customer->id,
            'name' => $this->customer->name,
            'email' => $this->customer->email,
            'phone' => $this->customer->phone,
            'disposition' => $this->customer->disposition,
            'process' => $this->customer->process,
            'salesperson' => $this->customer->salesperson->name ?? 'N/A',
        ];
    }
}
