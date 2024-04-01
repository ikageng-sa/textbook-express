@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            My books
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 0 @endphp
                    @forelse($books as $book)
                    @php $n++ @endphp
                    <tr>
                        <th scope="row">{{ $n }}</th>
                        <td>{{ $book->title }}</td>
                        <td>R {{ $book->price }}</td>
                        <td>{{ $book->status }}</td>
                        <td><a href="{{ route('book.show',['book' => $book->id]) }}" class="btn btn-sm btn-outline-success"><span class="bi bi-view-list"></span></a>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>





@endsection