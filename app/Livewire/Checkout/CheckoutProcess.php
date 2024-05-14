<?php

namespace App\Livewire\Checkout;

use App\Models\Address;
use App\Models\DeliveryMethod;
use Livewire\Component;

class CheckoutProcess extends Component
{

    public $delivery = false;
    public $pickup = false;
    public $address = false;

    public function setAddress(Address $address) {
        // Associate the address with the delivery

        $this->delivery = 'hidden';
        $this->address = true;

        return;
    }

    public function render()
    {

        $delivery_methods = DeliveryMethod::all();
        $addresses = auth()->user()->addresses;

        return view('livewire.checkout.checkout-process', [
            'methods' => $delivery_methods,
            'addresses' => $addresses,
        ]);
    }
}
