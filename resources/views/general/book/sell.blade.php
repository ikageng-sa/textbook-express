@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center">
        <h1 class="display-flex fs-5 text-sm-start text-md-center">Find the book you would like to sell</h1>
        <p class="fs-sm py-0 mt-0 mb-3 text-sm-start text-md-center">Request the book to be added if you can't find it</p>
        <form action="{{ route('general.book.sell') }}" method="POST" class="col-sm-12 col-md-6">
            @csrf
            <div class="row">
                <livewire:books.autocomplete-search />
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <x-input-label for='price'>{{ __('Price') }}</x-input-label>
                        <div class="input-group">
                            <span class="input-group-text">R</span>
                            <x-input-text name="price" required />
                        </div>
                        <x-input-error name='price' :message="$errors->get('price')" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <x-input-label for='condition'>{{ __('Condition') }}</x-input-label>
                        <select name="condition" class="form-select border-success-subtle" required>
                            <option value="" selected disabled>Select your book's condition</option>
                            @foreach($conditions as $condition)
                            <option value="{{ $condition }}">{{ ucFirst($condition) }}</option>
                            @endforeach
                        </select>
                        <x-input-error name='condition' :message="$errors->get('condition')" />
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="mb-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success col-sm-6 col-md-4 col-lg-2">Submit</button>
                </div>

            </div>
        </form>
    </div>
    @isset($status)
    @if($status)
    <div class="alert alert-success fw-bold" role="alert" style="width:fix-content;z-index:999;position:absolute;top:90%;left:50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%);">
        You have lost connectivity.
    </div>
    @else
    <div class="alert alert-danger fw-bold" role="alert" style="width:fix-content;z-index:999;position:absolute;top:90%;left:50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%);">
        You have lost connectivity.
    </div>
    @endif
    @endisset
</div>

@endsection