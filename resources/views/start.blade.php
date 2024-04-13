@extends('layouts.app')

@section('content')
<main class="container">

    <div class="row justify-content-center align-items-center" style="height:75vh;">
        <div class="col-12">
            <div class="cardc col-sm-12 col-md-6 p-4 text-center">
                <h2 class="fs-4 fw-bold display-6">Welcome to Our Bookstore</h2>
                <p class="lead fs-6">
                    Explore our collection by logging in or creating an account. Join us today to discover tailored literary delights.
                </p>
                <div class="row gap-3 mt-3 justify-content-around">
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-success rounded col-5">{{ __('Login') }}</a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-success rounded col-5">{{ __('Register') }}</a>
                </div>
            </div>
        </div>
    </div>

</main>


@endsection