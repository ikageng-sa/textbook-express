@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center">
        <form action="{{ route('book.store') }}" method="post" class="col-sm-12 col-md-6">
            @csrf
            <div class="book-details">
                <div class="row mb-3">
                    <h3 class="display-6">
                        Book Details
                    </h3>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                            <x-input-label for='title'>{{ __('Title') }}</x-input-label>
                            <x-input-text name='title' />
                            <x-input-error name='title' :message="$errors->get('title')" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                            <x-input-label for='author'>{{ __('Author') }}</x-input-label>
                            <x-input-text name='author' />
                            <x-input-error name='author' :message="$errors->get('author')" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                            <x-input-label for='isbn'>{{ __('ISBN') }}</x-input-label>
                            <x-input-text name='isbn' />
                            <x-input-error name='isbn' :message="$errors->get('isbn')" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                            <x-input-label for='edition'>{{ __('Edition') }}</x-input-label>
                            <x-input-text name='edition' />
                            <x-input-error name='edition' :message="$errors->get('edition')" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                            <x-input-label for='language'>{{ __('Language') }}</x-input-label>
                            <x-input-text name='language' />
                            <x-input-error name='language' :message="$errors->get('language')" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-1 d-flex justify-content-end">
                        <x-button>Submit</x-button>
                    </div>
                </div>
        </form>
    </div>
</div>

@endsection