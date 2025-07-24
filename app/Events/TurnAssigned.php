<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\SalesCheckin;

class TurnAssigned implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $salesperson_id;

    public function __construct($forceSalespersonId = null)
    {
        // Clear current turn
        SalesCheckin::where('is_current_turn', true)->update(['is_current_turn' => false]);

        // Step 1: If a specific salesperson ID is passed (manual override), use it
        if ($forceSalespersonId) {
            $target = SalesCheckin::where('salesperson_id', $forceSalespersonId)
                        ->whereNull('check_out_time')
                        ->latest('check_in_time')
                        ->first();
        } else {
            // Step 2: Automatically pick the earliest checked-in, not checked-out
            $target = SalesCheckin::whereNull('check_out_time')
                        ->orderBy('check_in_time', 'asc')
                        ->first();
        }

        // Step 3: Assign turn
        if ($target) {
            $target->update(['is_current_turn' => true]);
            $this->salesperson_id = $target->salesperson_id;
        }
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
        $first = SalesCheckin::where('is_current_turn', true)->first();

        return [
            'current_turn_id' => $first?->salesperson_id,
            'salesperson_id' => $first?->salesperson_id,
            'salesperson_name' => $first?->salesperson?->name ?? null,
            'salesperson_email' => $first?->salesperson?->email ?? null,
        ];
    }
}
