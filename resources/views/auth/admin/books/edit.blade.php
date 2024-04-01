@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    {{ $book->title }}'s book cover
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.books.updateCover', ['book' => $book->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @session('coverStatus')
                        <span class="text-success">{{ session('coverStatus') }}</span>
                        @endsession
                        <div class="input-group">
                            <input class="form-control form-control-sm" name="cover" type="file">
                            <x-button class="outline-success btn-sm input-group-text">Save</x-button>
                            <x-input-error name="cover" :message="$errors->get('cover')" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    {{ $book->title }} book details
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.books.updateDetails', ['book' => $book->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')                       
                        @session('detailsStatus')
                        <span class="text-success">{{ session('detailsStatus') }}</span>
                        @endsession
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="title">{{ __('Title') }} <span class="text-danger">*</span></x-input-label>
                                <x-input-text name="title" class=" form-control form-control-sm border-success-subtle" value="{{ $book->title ?? '' }}" required />
                                <x-input-error name="title" :message="$errors->get('titlle')" />
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="author">{{ __('Author') }} <span class="text-danger">*</span></x-input-label>
                                <x-input-text name="author" class=" form-control form-control-sm border-success-subtle" value="{{ $book->author ?? '' }}" required />
                                <x-input-error name="author" :message="$errors->get('author')" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="isbn">{{ __('ISBN') }} <span class="text-danger">*</span></x-input-label>
                                <x-input-text name="isbn" class=" form-control form-control-sm border-success-subtle" value="{{ $book->isbn ?? '' }}" required />
                                <x-input-error name="isbn" :message="$errors->get('isbn')" />
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="edition">{{ __('Edition') }} <span class="text-danger">*</span></x-input-label>
                                <x-input-text name="edition" class=" form-control form-control-sm border-success-subtle" value="{{ $book->edition ?? '' }}" required />
                                <x-input-error name="edition" :message="$errors->get('edition')" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="publisher">{{ __('publisher') }}</x-input-label>
                                <x-input-text name="publisher" class=" form-control form-control-sm border-success-subtle" value="{{ $book->publisher ?? '' }}" />
                                <x-input-error name="publisher" :message="$errors->get('publisher')" />
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="publication_date">{{ __('Publication date') }}</x-input-label>
                                <x-input-text type="date" name="publication_date" class=" form-control form-control-sm border-success-subtle" value="{{ $book->publication_date ?? '' }}" />
                                <x-input-error name="publication_date" :message="$errors->get('publication_date')" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="category">{{ __('Category') }} <span class="text-danger">*</span></x-input-label>
                                <x-input-text name="category" class=" form-control form-control-sm border-success-subtle" value="{{ $book->category ?? '' }}" required />
                                <x-input-error name="category" :message="$errors->get('category')" />
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <x-input-label for="language">{{ __('Language') }} <span class="text-danger">*</span></x-input-label>
                                <x-input-text name="language" class=" form-control form-control-sm border-success-subtle" value="{{ $book->language ?? '' }}" required />
                                <x-input-error name="language" :message="$errors->get('language')" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <x-input-label for="description">{{ __('Description') }}</x-input-label>
                                <x-input-textarea name="description" class="form-control form-control-sm border-success-subtle">{{ $book->description ?? '' }}</x-input-textarea>
                                <x-input-error name="description" :message="$errors->get('description')" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <x-button class="outline-success btn-sm">Update</x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection