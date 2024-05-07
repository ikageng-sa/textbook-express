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


    @if(empty($books))
    <div class="card">
        <div class="card-header">
            Search
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Title</th>
                        <th scope="col">Edition</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 0 @endphp
                    @forelse($books as $book)
                    @php $n++ @endphp
                    <tr>
                        <th scope="row">{{ $n }}</th>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->edition ?? '-' }}</td>
                        <td>R {{ $book->price }}</td>
                        <td>{{ ucFirst($book->status) }}</td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
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