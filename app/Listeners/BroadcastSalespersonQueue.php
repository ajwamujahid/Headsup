<?php

namespace App\Listeners;

use App\Events\SalespersonCheckedIn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BroadcastSalespersonQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        Broadcast::channel('sales-turns', function () {
            return true;
        });
        
    }

    /**
     * Handle the event.
     */
    public function handle(SalespersonCheckedIn $event): void
    {
        //
    }
}
