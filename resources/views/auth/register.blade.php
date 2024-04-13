@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center">
            <div class="card col-12">
                <div class="card-body">
                    <h1 class="display-5 fs-4">{{ __('Register') }}</h1>
                    <p class="lead fs-6">Submit the form to create an account.</p>

                    <form method="post" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3">
                                <x-input-label for="name">{{ __('Name') }}</x-input-label>
                                <x-input-text name="name" required />
                                <x-input-error name="name" :message="$errors->get('name')" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <x-input-label for="email">{{ __('Email Address') }}</x-input-label>
                                <x-input-text name="email" type="email" required />
                                <x-input-error name="name" :message="$errors->get('name')" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <x-input-label for="password">{{ __('Password') }}</x-input-label>
                                <x-input-text name="password" type="password" required autocomplete="new-password" />
                                <x-input-error name="password" :message="$errors->get('password')" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <x-input-label for="confirm-password">{{ __('Confirm Password') }}</x-input-label>
                                <x-input-text name="password_confirmation" type="password" required autocomplete="new-password" />
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-success col-sm-6 col-md-4">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                        <p class="lead fs-6 my-3">Already have an account? Go to <a href="{{ route('login') }}">{{ __('Login') }}</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection