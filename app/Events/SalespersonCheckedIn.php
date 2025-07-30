<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SalespersonCheckedIn implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $salespersonName;
    public $salespersonId;
    public $isCurrentTurn;

    public function __construct($salespersonName, $salespersonId, $isCurrentTurn = false)
    {
        $this->salespersonName = $salespersonName;
        $this->salespersonId = $salespersonId;
        $this->isCurrentTurn = $isCurrentTurn;
    }

    public function broadcastOn()
    {
        return new Channel('sales-checkins');
    }

    public function broadcastWith()
    {
        \Log::info('📢 Broadcasting SalespersonCheckedIn: ' . $this->salespersonName . ' (ID: ' . $this->salespersonId . ') | isCurrentTurn: ' . ($this->isCurrentTurn ? 'Yes' : 'No'));

        return [
            'salesperson_name' => $this->salespersonName,
            'salesperson_id' => $this->salespersonId,
            'is_current_turn' => $this->isCurrentTurn ? 1 : 0,
        ];
    }
}
