<?php

namespace App\Livewire\Cart;

use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    #[On('update-cart')]
    public function render()
    {
        $cart = auth()->user()->cart;
        
        if($cart) $cart = $cart->items; // Get items from cart if it exists

        return view('livewire.cart.show', [
            'cart' => $cart
        ]);
    }
}
