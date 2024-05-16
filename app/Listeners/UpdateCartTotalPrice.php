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
        $cart = $event->cart;
        $total_amount = $cart->items->pluck('price')->sum();
        $cart->amount = $total_amount;
        $cart->save();
    }
}
