<?php

namespace App\Livewire\Cart;

use App\Enums\TransactionStatus;
use App\Events\CartChanged;
use App\Models\Cart;
use App\Models\Transaction;
use Livewire\Component;

class AddToCart extends Component
{

    public $book;
    public $class= '';
    public $style= '';
    public $slot= '';

    public function add()
    {
        if(!auth()->user()) return redirect()->route('login');

            $cart = auth()->user()->cart;

        if (!$cart) {
            $cart = Transaction::create([
                'user_id' => auth()->user()->id,
                'status' => TransactionStatus::CART,
                'amount' => 0
            ]);
        }

        $bookExistsInCart = $cart->findItem($this->book, 'item_id')->get(); //->whereIn('item_id', $this->book);

        if (count($bookExistsInCart) !== 0) {  
            session()->flash('alert', 'Already added to cart');        
            $this->dispatch('show-alert');
            return;
        }

        $order = Cart::create([
            'transaction_id' => $cart->id,
            'item_id' => $this->book
        ]);

        session()->flash('alert', 'Added to cart');
        $this->dispatch('update-cart'); 

        // Dispatch an event to update the total amount
        CartChanged::dispatch(auth()->user());     

        return;
    }

    public function render()
    {
        return view('livewire.cart.add-to-cart');
    }
}
