<?php

namespace App\Livewire\Cart;

use App\Enums\TransactionStatus;
use App\Models\Transaction;
use Livewire\Attributes\On;
use Livewire\Component;

class TotalCartAmount extends Component
{
    #[On('update-cart')]
    public function render()
    {
        $user = auth()->user();

        if ($user->cart == null) {
            Transaction::create([
                'user_id' => $user->id,
                'amount' => 0,
                'status' => TransactionStatus::CART
            ]);
        }

        $amount = $user->cart->amount;

        return view('livewire.cart.total-cart-amount', [
            'amount' => $amount,
        ]);
    }
}
