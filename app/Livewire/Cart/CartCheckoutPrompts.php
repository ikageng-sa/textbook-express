<?php

namespace App\Livewire\Cart;

use Livewire\Attributes\On;
use Livewire\Component;

class CartCheckoutPrompts extends Component
{
    #[On('update-cart')]
    public function render()
    {
        $cartHasItems = auth()->user()->cart->items->count();

        return view('livewire.cart.cart-checkout-prompts', [
            'hasItems' => $cartHasItems,
        ]);
    }
}
