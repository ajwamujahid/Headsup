<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\SalesCheckedIn;
use App\Listeners\AssignTurnListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\SalesCheckedIn::class => [
            \App\Listeners\AssignTurnListener::class,
        ],
        \App\Events\CustomerTransferred::class => [
            \App\Listeners\UpdateCheckinTransferredCount::class,
        ],
    ];
    
  
    public function boot(): void
    {
        //
    }
}
