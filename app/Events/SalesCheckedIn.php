<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\SalesCheckin;

class SalesCheckedIn implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $salesperson;
    public $current_turn_id;

    public function __construct($salesperson, $current_turn_id)
    {
        $this->salesperson = $salesperson;
        $this->current_turn_id = $current_turn_id;
    }
    
    public function broadcastOn()
    {
        return new Channel('sales-turn');
    }

    
public function broadcastWith()
{
    $first = SalesCheckin::where('is_current_turn', true)->first();

    \Log::info('📢 Broadcasting TurnAssigned with current_turn_id: ' . ($first?->salesperson_id ?? 'null'));

    return [
        'current_turn_id' => $first?->salesperson_id,
    ];
}

    
}
