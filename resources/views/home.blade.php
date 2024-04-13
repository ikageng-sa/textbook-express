@extends('layouts.app')

@section('content')
<div class="container">

    @if(count($myBooks) > 0)
    <div class="row row-gap">
        <div class="row">
            <h1>My Books</h1>
        </div>
        <div class="col-12 flex wrap content">
            @forelse($myBooks as $book)
            <div class="book _container">
                <div class="_cover  faded d-flex justify-content-center align-items-end text-light pb-3" style="background-image: url( '/{{ $book->cover ? $book->cover : images/no_image }}');"></div>
                <h3 class="title">{{ $book->title }}</h3>
                <p class="sub-title truncate text-center">{{ $book->author ?? '' }}</p>
                <p class="price text-end">R {{ $book->price }}</p>
            </div>
            @empty
            @endforelse
        </div>
    </div>
    @endif

    @if(count($newBooks) > 3)
    <div class="row">
        <div class="row">
            <h1>Newly Listed Books</h1>
        </div>
        <div class="col-12 flex wrap content">
            @forelse($newBooks as $book)
            @if($book->seller !== auth()->user()->id)
            <div class="book _container">
                <div class="_cover  faded d-flex justify-content-center align-items-end text-light pb-3" style="background-image: url( '/{{ $book->cover ? $book->cover : images/no_image }}');"></div>
                <h3 class="title">{{ $book->title }}</h3>
                <p class="sub-title truncate text-center">{{ $book->author ?? '' }}</p>
                <p class="price text-end">R {{ $book->price }}</p>
            </div>
            @endif
            @empty
            @endforelse
        </div>
    </div>
    @endif

</div>


@endsection