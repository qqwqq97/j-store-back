<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrderCompleted;
use App\Jobs\SendOrderCompletedMailToAdminJob;

class SendOrderCompletedMailToAdmin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCompleted $event): void
    {
        SendOrderCompletedMailToAdminJob::dispatch($event->order);
    }
}
