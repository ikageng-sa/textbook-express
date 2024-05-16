<div class="">
    <div class="row align-items-center flex-row flex-column my-5" >
        @if($step === 'delivery-method' )
        <div wire:transition.out.opacity>
            <h1 class="w-auto mb-5 text-center">Delivery Method</h1>
            <div class="d-flex flex-column gap-3 col-sm-100 col-md-6 col-lg-4">
                <div class="d-flex flex-column gap-1">
                    @forelse($methods as $method)
                    <button wire:click="setDeliveryMethod({{ $method->id }})" type="button" class="card text-start border border-dark p-3 flex-row align-items-center icon-link icon-link-hover " style="height:5rem;" style="--bs-icon-link-transform: translate3d(.125rem, 0, 0); --bs-link-hover-color-rgb: 255, 0, 0;">
                        <div>
                            <h2 class="text-secondary my-0">{{ $method->method }}</h2>
                            <p class="fs-sm fw-light my-0">{{ $method->description }}</p>
                        </div>
                        <div class="ms-auto h-100 d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                            </svg>
                        </div>
                    </button>
                    @empty
                    @endforelse

                </div>
            </div>
        </div>
        @endif

        @if($step === 'delivery-address' )
        <div wire:transition.in.opacity.duration.200ms>
            <h1 class="w-auto mb-5 text-center">Delivery Address</h1>
            <div class="d-flex flex-column gap-3 col-sm-100 col-md-6 col-lg-4">
                <div class="d-flex flex-column gap-1">
                    @forelse($addresses as $address)
                    <button wire:click="setAddress({{ $address->id }})" type="button" class="card p-3 text-start" style="min-height:5rem;">
                        <div class="col-12 d-flex justify-content-between">
                            <h3 class="fs-sm text-secondary">{{ $address->name }}</h3>
                        </div>
                        <p class="fw-light fs-6 m-0">{{ $address->street_address }}, {{ $address->city }}, {{ $address->province }}, {{ $address->postal_code }}</p>
                    </button>
                    @empty
                    <a href="{{ route('general.profile.addresses.create') }}" class="card btn btn-outline-secondary p-3 d-flex justify-content-center align-items-center" style="min-height:5rem;">
                        <i class="bi bi-plus-lg"></i>
                    </a>
                    @endforelse
                </div>
            </div>
        </div>
        @endif

        @if($step === 'payment-method' )
        <div wire:transition.in.opacity.duration.200ms>
            <h1 class="w-auto mb-5 text-center">Payment Method</h1>
            <div class="d-flex flex-column gap-3 col-sm-100 col-md-6 col-lg-4">
                <div class="d-flex flex-column gap-1">
                    <button wire:click="setPaymentMethod('credit/debit card')" type="button" class="card text-start p-3 flex-row align-items-center" style="min-height:5rem;">
                        <h2 class="bi bi-credit-card my-0 me-2"></h2>
                        <div class="">
                            <h2 class="text-secondary my-0">Credit/Debit Card</h2>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>