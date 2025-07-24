<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\SalesCheckin;
use App\Events\TurnAssigned;

class AssignCustomerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        // Reset any existing current turn
        \App\Models\SalesCheckin::whereDate('created_at', today())
            ->where('is_current_turn', true)
            ->update(['is_current_turn' => false]);
    
        // Find next eligible salesperson
        $next = \App\Models\SalesCheckin::whereDate('created_at', today())
            ->whereNull('check_out_time')
            ->where('has_taken_customer', false)
            ->orderBy('check_in_time')
            ->first();
    
        if ($next) {
            $next->update(['is_current_turn' => true]);
    
            broadcast(new \App\Events\TurnAssigned($next->salesperson_id));
            \Log::info("🎯 Turn assigned to salesperson ID {$next->salesperson_id}");
        } else {
            \Log::info("🚫 No eligible salesperson found to assign turn.");
        }
    }
    
}
