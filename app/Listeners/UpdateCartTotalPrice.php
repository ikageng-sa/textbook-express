<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateCartTotalPrice
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = $event->user;
        $total_amount = $user->cart->items->pluck('price')->sum();
        $user->cart->amount = $total_amount;
        $user->cart->save();
    }
}
