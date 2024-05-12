@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8 col-lg-6">
            <form class="mt-2" action="{{ route('general.book.search') }}" method="get">
                <div class="input-group input-group mb-3">
                    <input class="form-control" type="text" name="query" value="{{ $query ?? '' }}" placeholder="Enter Title or ISBN...">
                    <button class="input-group-text btn btn-primary" type="submit" name="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>



    @if(count($books) !== 0)
    <div class="row row-gap">
        <div class="col-12 d-flex flex-wrap gap-2 row-gap-2 content">
            @foreach($books as $book)
            <x-book route="{{ route('general.book.show', ['book' => $book->id]) }}" :details="$book" />
            @endforeach
        </div>
    </div>
    @else
    <div class="row" style="height:70vh;">
        <div class="col-12 d-flex justify-content-center align-items-center flex-column text-center">
            <span class="bi bi-box2 text-secondary" style="font-size:8rem;"></span>
            <p>No search results</p>
        </div>
    </div>
    @endif




</div>
@endsection