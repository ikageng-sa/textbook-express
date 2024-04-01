@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    Record a New Book
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.books.store') }}" method="post" enctype="multipart/form-data">
                        @csrf                       
                        @session('status')
                        <span class="text-success">{{ session('status') }}</span>
                        @endsession
                        <div class="row mb-3">
                            <div class="col-12">
                                <x-input-label for="cover">{{ __('Book Cover') }} <span class="text-danger">*</span></x-input-label>
                                <x-input-text class="form-control form-control-sm" name="cover" type="file" />
                                <x-input-error name="cover" :message="$errors->get('cover')" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="title">{{ __('Title') }} <span class="text-danger">*</span></x-input-label>
                                <x-input-text name="title" class=" form-control form-control-sm border-success-subtle" value="{{ old('title') }}" required />
                                <x-input-error name="title" :message="$errors->get('titlle')" />
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="author">{{ __('Author') }} <span class="text-danger">*</span></x-input-label>
                                <x-input-text name="author" class=" form-control form-control-sm border-success-subtle" value="{{ old('author') }}" required />
                                <x-input-error name="author" :message="$errors->get('author')" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="isbn">{{ __('ISBN') }} <span class="text-danger">*</span></x-input-label>
                                <x-input-text name="isbn" class=" form-control form-control-sm border-success-subtle" value="{{ old('isbn') }}" required />
                                <x-input-error name="isbn" :message="$errors->get('isbn')" />
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="edition">{{ __('Edition') }} <span class="text-danger">*</span></x-input-label>
                                <x-input-text name="edition" class=" form-control form-control-sm border-success-subtle" value="{{ old('edition') }}" required />
                                <x-input-error name="edition" :message="$errors->get('edition')" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="publisher">{{ __('publisher') }}</x-input-label>
                                <x-input-text name="publisher" class=" form-control form-control-sm border-success-subtle" value="{{ old('publisher') }}" />
                                <x-input-error name="publisher" :message="$errors->get('publisher')" />
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="publication_date">{{ __('Publication date') }}</x-input-label>
                                <x-input-text type="date" name="publication_date" class=" form-control form-control-sm border-success-subtle" value="{{ old('publication_date') }}" />
                                <x-input-error name="publication_date" :message="$errors->get('publication_date')" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="category">{{ __('Category') }} <span class="text-danger">*</span></x-input-label>
                                <x-input-text name="category" class=" form-control form-control-sm border-success-subtle" value="{{ old('category') }}" required />
                                <x-input-error name="category" :message="$errors->get('category')" />
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="language">{{ __('Language') }} <span class="text-danger">*</span></x-input-label>
                                <x-input-text name="language" class=" form-control form-control-sm border-success-subtle" value="{{ old('language') }}" required />
                                <x-input-error name="language" :message="$errors->get('language')" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <x-input-label for="description">{{ __('Description') }} <span class="text-danger">*</span></x-input-label>
                                <x-input-textarea name="description" class="form-control form-control-sm border-success-subtle">{{ old('description') }}</x-input-textarea>
                                <x-input-error name="description" :message="$errors->get('description')" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <x-button class="outline-success btn-sm">Save</x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection