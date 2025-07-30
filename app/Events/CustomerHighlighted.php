<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerHighlighted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $customerId;
    public $salespersonName;

    public function __construct($customerId, $salespersonName)
    {
        $this->customerId = $customerId;
        $this->salespersonName = $salespersonName;
    }

    public function broadcastOn()
    {
        return new Channel('queue-highlights');
    }

    public function broadcastAs()
    {
        return 'Customer.Highlighted';
    }
}
