<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TurnAssigned implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $salesperson_id;
    public $salesperson_name;
    public $salesperson_email;

    public function __construct($salesperson_id, $salesperson_name, $salesperson_email)
    {
        $this->salesperson_id = $salesperson_id;
        $this->salesperson_name = $salesperson_name;
        $this->salesperson_email = $salesperson_email;
    }

    public function broadcastOn()
    {
        return new Channel('sales-turn');
    }

    public function broadcastAs()
    {
        return 'TurnAssigned';
    }

    public function broadcastWith()
    {
        \Log::info('Broadcasting TurnAssigned', [
            'current_turn_id' => $this->salesperson_id,
            'salesperson_name' => $this->salesperson_name
        ]);

        return [
            'current_turn_id' => $this->salesperson_id,
            'salesperson_id' => $this->salesperson_id,
            'salesperson_name' => $this->salesperson_name,
            'salesperson_email' => $this->salesperson_email,
        ];
    }
}
