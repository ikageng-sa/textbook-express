@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="card col-sm-12 col-md-6 col-sm-3">
                <div class="card-body">
                    <h1 class="display-5 fs-4">{{ __('Login') }}</h1>
                    <p class="lead fs-6">Submit the form to access your account.</p>

                    <form method="POST" action="{{ route('login') }}" class="col-12">
                        @csrf
                        <div class="row">
                            <div class="mb-3">
                                <x-input-label for="email">{{ __('Email Address') }}</x-input-label>
                                <x-input-text type="email" name='email' autocomplete required />
                                <x-input-error name="email" :message="$errors->get('email')" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <x-input-label for="password">{{ __('Password') }}</x-input-label>
                                <x-input-text type="password" name='password' autocomplete required />
                                <x-input-error name="password" :message="$errors->get('password')" />
                            </div>
                        </div>
                        <div class="form-check form-control-sm mt-0 pt-0">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 ">
                                <button type="submit" class="btn btn-success col-sm-6 col-md-4">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                        <p class="lead fs-6 my-3">Don't have an account with us? <a href="{{ route('register') }}">{{ __('Register') }}</a></p>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection