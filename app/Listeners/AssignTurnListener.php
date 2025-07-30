<?php

namespace App\Listeners;

use App\Events\SalesCheckedIn;
use App\Events\TurnAssigned;
use App\Models\SalesCheckin;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssignTurnListener implements ShouldQueue
{
    public function handle(SalesCheckedIn $event)
    {
        // Find the first checked-in salesperson who hasn't checked out
        $firstCheckin = SalesCheckin::where('checked_out', 0)
                        ->orderBy('created_at')
                        ->first();

        if ($firstCheckin) {
            broadcast(new TurnAssigned(
                $firstCheckin->salesperson_id,
                $firstCheckin->salesperson->name
            ));
        }
    }
}
