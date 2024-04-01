@extends('layouts.app')

@section('content')
<div class="container">
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
</div>





@endsection