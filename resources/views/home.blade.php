@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
    <div class="col-sm-12 col-md-6 mb-3">
        <div class="card p-3">
            <div class="card-body">
                <h1>Welcome Back {{ auth()->user()->name }}</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 mb-3 text-center">
        <h2>Suggestions</h2>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('search') }}" class="btn btn-dark"><span class="bi bi-search"></span>&nbsp;Search</a>
                <a href="{{ route('sell') }}" class="btn btn-dark"><span class="bi bi-card-list"></span>&nbsp;History</a>
                <a href="{{ route('sell') }}" class="btn btn-dark"><span class="bi bi-receipt"></span>&nbsp;Sell</a>
            </div>
        </div>
    </div>

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