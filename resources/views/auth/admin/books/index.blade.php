@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    </div>
    <div class="row mb-3">
        <div class="col-12 d-flex gap-2">
            @can('view book')
            <div class="col-4">
                <form class="" action="{{ route('admin.books.search') }}" method="get">
                    <div class="input-group input-group-sm">
                        <input class="form-control" type="text" name="query" value="{{ $query ?? '' }}" placeholder="Enter Title or ISBN...">
                        <button class="input-group-text btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
            @endcan
            @can('create book')
            <a href="{{ route('admin.books.create') }}" class="btn btn-sm btn-success">New Book <span class="bi bi-plus"></span></a>
            @endcan
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            {{ $pageTitle }}
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author(s)</th>
                        <th scope="col">Edition</th>
                        <th scope="col">Category</th>
                        <th scope="col">Language</th>
                        <th scope="col">Added By</th>
                        <th scope="col">Reviewed By</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 0 @endphp
                    @forelse($books as $book)
                    @php $n++ @endphp
                    <tr>
                        <th scope="row">{{ $n }}</th>
                        <th><img src="{{ isset($book->cover) ? '/'.$book->cover : '/images/no_image.png' }}" alt="" style="height:3rem;width:2rem;"></th>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->edition ?? '-' }}</td>
                        <td>{{ $book->category ?? '-' }}</td>
                        <td>{{ $book->language ?? '-' }}</td>
                        <td>{{ $book->adder ?? '-' }}</td>
                        <td>{{ $book->reviewer ?? '-' }}</td>
                        @can('update book')
                        <td><a href="{{ route('admin.books.edit',['book' => $book->id]) }}" class="btn btn-sm btn-outline-success"><span class="bi bi-pen"></span></a>
                        @endcan
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection