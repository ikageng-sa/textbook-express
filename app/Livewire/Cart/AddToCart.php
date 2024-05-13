<?php

namespace App\Livewire\Cart;

use App\Enums\TransactionStatus;
use App\Models\Order;
use App\Models\Transaction;
use Livewire\Component;

class AddToCart extends Component
{

    public $book;
    public $class= '';

    public function add()
    {
        $book = $this->book;        

        if(!auth()->user()) return redirect()->route('login');

            $cart = auth()->user()->cart;


        if (!$cart) {
            $cart = Transaction::create([
                'user_id' => auth()->user()->id,
                'status' => TransactionStatus::CART,
                'amount' => 0
            ]);
        }

        $bookExistsInCart = $cart->items->whereIn('item_id', $this->book);


        if (count($bookExistsInCart) !== 0) {  
            session()->flash('alert', 'Already added to cart');        
            $this->dispatch('show-alert');
            return;
        }

        $order = Order::create([
            'transaction_id' => $cart->id,
            'item_id' => $this->book
        ]);

        session()->flash('alert', 'Added to cart');
        $this->dispatch('update-cart'); 

        return;
    }

    public function render()
    {
        return view('livewire.cart.add-to-cart');
    }
}
