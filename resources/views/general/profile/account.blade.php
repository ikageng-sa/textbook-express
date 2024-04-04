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

    <div class="row d-flex align-items-center flex-column my-5">
        <h1 class="w-auto mb-5 text-center">Your Account <i class="bi bi-person"></i></h1>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <form action="{{ route('general.profile.account.update', ['user' => auth()->user()->id]) }}" method="POST">
                @csrf
                @method('PUT')
                @session('status')
                    <span class="text-success">{{ session('status') }}</span>
                @endsession
                <div class="mb-3">
                    <div class="form-floating">
                        <x-input-text name="name" class="form-control" value="{{ $user->name }}" />
                        <x-input-label for="name">Full Name</x-input-label>
                    </div>
                    <x-input-error name="name" :message="$errors->first('name')" />
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <div class="form-floating">
                            <x-input-text type="email" name="email" class="form-control" value="{{ $user->email }}" />
                            <x-input-label for="email">Email Address</x-input-label>
                        </div>
                        <span class="input-group-text"><i class="bi bi-star text-danger"></i></span>
                    </div>
                    <x-input-error name="email" :message="$errors->first('email')" />
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <div class="form-floating">
                            <x-input-text type="tel" name="phone_number" class="form-control" value="{{ $user->phone_number }}" />
                            <x-input-label for="phone_number">Phone Number</x-input-label>
                        </div>
                        <span class="input-group-text"><i class="bi bi-star text-danger"></i></span>
                    </div>
                    <x-input-error name="phone_number" :message="$errors->first('phone_number')" />
                </div>
                <div class="">
                    <div class="col-12">
                        <x-button type="submit" class="btn btn-success col-sm-6 col-md-4">
                            {{ __('Update') }}
                        </x-button>

                        @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('general.account.password.reset') }}">
                            {{ __('Reset my password') }}
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection