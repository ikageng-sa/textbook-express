<?php

namespace App\Livewire\Checkout;

use App\Models\Address;
use App\Models\DeliveryMethod;
use App\Models\Order;
use Livewire\Attributes\Url;
use Livewire\Component;

class CheckoutProcess extends Component
{

    #[Url('step', true, true)]
    public $step = 'delivery-method';

    public function __construct()
    {

        // redirect to checkout step 1 if user hasn't selected a delivery method for the checkout
    }

    public function setDeliveryMethod(DeliveryMethod $method)
    {

        $user = auth()->user();
        $order = $user->cart->order;
        
        $order->delivery_method_id = $method->id;
        $order->save();

        $this->step = 'delivery-address';

        return;
    }

    public function setAddress(Address $address)
    {
        
        $user = auth()->user();
        $order = $user->cart->order;

        $order->address_id = $address->id;
        $order->save();

        $this->step = 'payment-method';

        return;
    }

    public function setPaymentMethod($method)
    {
        
        $user = auth()->user();

        if($method == 'credit/debit card')
        {
            $order = $user->cart->order;
            $order->payment_method = $method;
            $order->save();
        }else {
            return abort(404);
        }        

        return redirect()->route('checkout.overview');
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
