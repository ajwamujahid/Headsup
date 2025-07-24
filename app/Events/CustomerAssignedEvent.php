<?php
namespace App\Events;

use App\Models\Customer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class CustomerAssignedEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function broadcastOn()
    {
        return new Channel('customer-channel');
    }

    public function broadcastAs()
    {
        return 'customer.assigned';
    }
}
