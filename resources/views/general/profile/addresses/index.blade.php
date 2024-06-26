@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">

        <a class="icon-link icon-link-hover text-decoration-none" onclick="history.back()" style="--bs-icon-link-transform: translate3d(-.125rem, 0, 0); --bs-link-hover-color-rgb: 255, 0, 0;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg>
            Go Back
        </a>

    </div>

    <div class="row d-flex align-items-center flex-column my-5" style="min-height:80vh;">
        <h1 class="w-auto mb-5 text-center">Your Address Book <i class="bi bi-building-add"></i></h1>
        <div class="d-flex flex-column gap-3 col-sm-100 col-md-6 col-lg-4">
            @session('status')
                <span class="text-success">{{ session('status') }}</span>
            @endsession
            <div class="d-flex flex-column gap-1">
                @forelse($addresses as $address)
                <div class="card p-3" style="min-height:5rem;">
                    <div class="col-12 d-flex justify-content-between">
                        <h3 class="fs-sm text-secondary">{{ $address->name }}</h3>
                        <div class="dropdown">
                            <a class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="text-dark bi bi-three-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('general.profile.addresses.edit', ['address' => $address->id]) }}" class="dropdown-item">Edit</a></li>
                                <li><a href="{{ route('general.profile.addresses.destroy', ['address' => $address->id]) }}" class="dropdown-item">Delete</a></li>
                            </ul>
                        </div>
                    </div>
                    <p class="fw-light fs-6 m-0">{{ $address->street}}, {{ $address->city }}, {{ $address->province }}, {{ $address->code }}</p>
                </div>
                @empty
                <p class="text-secondary fs-sm text-center">No addresses recorded</p>
                @endforelse

                <a href="{{ route('general.profile.addresses.create') }}" class="card btn btn-outline-secondary p-3 d-flex justify-content-center align-items-center" style="min-height:5rem;">
                    <i class="bi bi-plus-lg"></i>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection