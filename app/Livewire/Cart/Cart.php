<?php

namespace App\Livewire\Cart;

use App\Enums\TransactionStatus;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    #[On('update-cart')]
    public function render()
    {

        $cart = auth()->user()->cart;

        $items = ($cart) ? count($cart->items) : 0;

        return view('livewire.cart.cart', [
            'items' => $items,
        ]);
    }
}
