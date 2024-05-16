@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row align-items-center flex-row flex-column my-5 text-center" >
        <h2 class="mb-3">Overview</h2>
        <div class="row justify-content-center">
            <div class="row flex-row justify-content-between mb-4 p-3 mx-3" style="border-color:var(--color-variant-dark);">
                <h3 class="">Delivery Address</h3>
                <small class="w-100 text-center">{{ $order->street_address }}, {{ $order->city }}, {{ $order->province }}, {{ $order->postal_code }}</small>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2">
                <div class="row text-start flex-row justify-content-between p-3 mx-3" style="border-color:var(--color-variant-dark);">
                    <small class="fw-bold w-auto">Total Cart Cost</small>
                    <small class="w-auto">R {{ $cart_amount }}</small>
                </div>
                <div class="row text-start flex-row justify-content-between border-top p-3 mx-3" style="border-color:var(--color-variant-dark);">
                    <small class="fw-bold w-auto">Delivery Cost</small>
                    <small class="w-auto">R {{ $order->cost }}</small>
                </div>
                <div class="row text-start flex-row justify-content-between border-top p-3 mx-3" style="border-color:var(--color-variant-dark);">
                    <small class="fw-bold w-auto">Total Amount</small>
                    <small class="w-auto">R {{ number_format($cart_amount + $order->cost, 2, '.', '') }}</small>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column gap-3 col-sm-100 col-md-6 col-lg-4">
        <a href="{{ route('checkout.stripe') }}" class="btn btn-secondary col-12 d-flex align-items-center justify-content-center mt-5" style="height:4rem;">Proceed to payment</a>
        </div>
    </div>
</div>
@endsection