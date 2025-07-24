<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\SalesCheckin;
use App\Events\TurnAssigned;
class AssignTurnJob implements ShouldQueue
{
    use Queueable;
    public function __construct()
    {
        //
    }
    public function handle()
    {
        $current = SalesCheckin::where('is_current_turn', true)->first();
        if ($current) return;
    
        $next = SalesCheckin::whereNull('check_out_time')
            ->where('has_taken_customer', false)
            ->orderBy('check_in_time', 'asc')
            ->first();
    
        if ($next) {
            $next->update(['is_current_turn' => true]);
    
            broadcast(new TurnAssigned($next->salesperson_id));
        }
    }
    

    }
    

