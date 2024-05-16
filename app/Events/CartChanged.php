<?php

namespace App\Events;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CartChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $cart;
    /**
     * Create a new event instance.
     */
    public function __construct(Transaction $cart)
    {
        $this->cart = $cart;
    }
}
