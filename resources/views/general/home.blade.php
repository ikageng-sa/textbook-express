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
                <a href="{{ route('general.book.search') }}" class="btn btn-dark"><span class="bi bi-search"></span>&nbsp;Search</a>
                <a href="" class="btn btn-dark"><span class="bi bi-card-list"></span>&nbsp;History</a>
                <a href="{{ route('general.book.show-sell-form') }}" class="btn btn-dark"><span class="bi bi-receipt"></span>&nbsp;Sell</a>
            </div>
        </div>
    </div>

    @if(count($myBooks) > 0)
    <div class="row row-gap">
        <div class="row">
            <h1>My Books</h1>
        </div>
        <div class="col-12 d-flex flex-wrap gap-2 row-gap-2 content">
            @forelse($myBooks as $book)
            <x-book route="#" :details="$book"/>
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
        <div class="col-12 d-flex flex-wrap content">
            @forelse($newBooks as $book)
            @if($book->seller !== auth()->user()->id)
            <x-book route="{{ route('book.show', ['book' => $book->id]) }}" :details="$book" />
            @endif
            @empty
            @endforelse
        </div>
    </div>
    @endif

</div>


@endsection