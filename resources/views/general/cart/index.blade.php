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
        <h1 class="w-auto mb-5 text-center">Cart <i class="bi bi-cart"></i></h1>
        <div class="d-flex flex-column gap-3 col-sm-100 col-md-6 col-lg-4">
            <livewire:cart.show lazy />
        </div>
    </div>
</div>

@endsection