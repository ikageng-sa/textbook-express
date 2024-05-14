<?php

namespace App\Livewire\Cart;

use Livewire\Attributes\On;
use Livewire\Component;

class TotalCartAmount extends Component
{
    #[On('update-cart')]
    public function render()
    {
        $amount = auth()->user()->cart->pluck('amount');

        return view('livewire.cart.total-cart-amount',[
            'amount' => $amount[0],
        ]);
    }
}
