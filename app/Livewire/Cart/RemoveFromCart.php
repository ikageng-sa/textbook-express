<?php

namespace App\Livewire\Cart;

use App\Events\CartChanged;
use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Component;

class RemoveFromCart extends Component
{
    public $book;

    public function remove()
    {

        $cart = auth()->user()->cart;
        $cart->findItem($this->book)->first()->forceDelete(); //->where('order', $this->book)->first();

        session()->flash('alert', 'Item removed from cart');        
        session()->flash('alert', 'Added to cart');
        $this->dispatch('update-cart'); 
        $this->dispatch('show-alert');

        CartChanged::dispatch($cart);     

        return;
    }

    public function render()
    {
        return view('livewire.cart.remove-from-cart');
    }
}
