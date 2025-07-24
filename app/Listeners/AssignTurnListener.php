<?php

namespace App\Listeners;

// use App\Events\SalesCheckedIn;
// use App\Events\TurnAssigned;
// use App\Models\SalesCheckin;
// namespace App\Listeners;

use App\Events\SalesCheckedIn;
use App\Jobs\AssignCustomerJob;

class AssignTurnListener
{
    public function handle(SalesCheckedIn $event)
    {
        AssignCustomerJob::dispatch();
    }
}
