@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <form class="mt-2" action="{{ route('search') }}" method="get">
                <div class="input-group input-group mb-3">
                    <input class="form-control" type="text" name="query" value="{{ $query ?? '' }}" placeholder="Enter Title or ISBN...">
                    <button class="input-group-text btn btn-primary" type="submit" name="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>


    @if($query == '')
    <div class="row" style="height:70vh;">
        <div class="col-12 d-flex justify-content-center align-items-center flex-column text-center">
            <span class="bi bi-box2 text-secondary" style="font-size:8rem;"></span>
            <p>No search results</p>
        </div>
    </div>
    @endif


    @if(!empty($books))
    <div class="row">
        <div class="col-12 gap-1 flex-wrap">
            @foreach($books as $book)
            @if($book->seller !== auth()->user()->id)
            <a href="{{ route('book.show', ['book' => $book->id]) }}" class="book _container">
                <div class="_cover  faded d-flex justify-content-center align-items-end text-light pb-3" style="background-image: url( '/{{ $book->cover ? $book->cover : images/no_image }}');"></div>
                <h3 class="title">{{ $book->title }}</h3>
                <p class="sub-title truncate text-center">{{ $book->author ?? '' }}</p>
                <p class="price text-end">R {{ $book->price }}</p>
            </a>
            @endif
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