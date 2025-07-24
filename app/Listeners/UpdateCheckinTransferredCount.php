<?php

namespace App\Listeners;
use App\Models\SalesCheckin;
use App\Events\CustomerTransferred;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateCheckinTransferredCount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

 
    public function handle(CustomerTransferred $event)
    {
        $salespersonId = $event->salesperson->id;
    
        $checkin = SalesCheckin::where('sales_profile_id', $salespersonId)
                    ->whereNull('checkout_at')
                    ->latest('checkin_at')
                    ->first();
    
        if ($checkin) {
            $checkin->increment('transferred_customers');
        }
    }
    
}
