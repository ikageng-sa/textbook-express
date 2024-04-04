@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Create a New Address
                    <a class="icon-link icon-link-hover text-decoration-none" onclick="history.back()" style="--bs-icon-link-transform: translate3d(-.125rem, 0, 0); --bs-link-hover-color-rgb: 255, 0, 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                        Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.permissions.store') }}" method="post">
                        @csrf
                        @session('status')
                        <span class="text-success">{{ session('status') }}</span>
                        @endsession
                        <div class="row">
                            <div class="mb-3">
                                <x-input-label class="form-label form-label-sm" for="name">Name Of Address</x-input-label>
                                <x-input-text name="name" class="form-control form-control-sm border-success-subtle" required />
                                <x-input-error name="name" :message="$errors->first('name')" />
                            </div>
                            <h3 class="fs-6 fw-light mt-3 mb-2">Address Details</h3>
                            <div class="row mb-3">
                                <div class="col-2">
                                    <x-input-label for="street_address">{{ __('Street') }}</x-input-label>
                                </div>
                                <div class="col-10">
                                    <x-input-text name="street_address" class="form-control form-control-sm border-success-subtle" required />
                                    <x-input-error name="street_address" :message="$errors->first('street_address')" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2">
                                    <x-input-label for="city">{{ __('City') }}</x-input-label>
                                </div>
                                <div class="col-10">
                                    <x-input-text name="city" class="form-control form-control-sm border-success-subtle" required />
                                    <x-input-error name="city" :message="$errors->first('city')" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2">
                                    <x-input-label for="province">{{ __('Province') }}</x-input-label>
                                </div>
                                <div class="col-10">
                                    <select class="form-select border-success-subtle" name="province_id">
                                        <option value="">Select a province</option>
                                        @foreach($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error name="province" :message="$errors->first('province')" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2">
                                    <x-input-label for="postal_code">{{ __('Postal Code') }}</x-input-label>
                                </div>
                                <div class="col-10">
                                    <x-input-text name="postal_code" class="form-control form-control-sm border-success-subtle" required />
                                    <x-input-error name="postal_code" :message="$errors->first('postal_code')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <input type="checkbox" name="is_primary" class="" autocomplete="off" />
                                    <x-input-label for="is_primary">{{ __('Make this my primary address') }}</x-input-label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <x-button class="success btn-sm">Save</x-button>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection