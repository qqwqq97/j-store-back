<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Order;
use App\Mail\OrderCompletedMail;
use Illuminate\Support\Facades\Mail;

class SendOrderCompletedMail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Order $order,
    )
    {
    
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->order->user->email)
        ->send(new OrderCompletedMail($this->order));
    }
}
