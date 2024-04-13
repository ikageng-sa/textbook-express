@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bm-3">
        <div class="col-sm-12 col-md-8 card">
            <div class="row p-2">
                <div class="card-body">
                    <h2 class="bm-3">Advanced Search</h2>
                    <div class="col-12">
                        <form action="{{ route('admin.books.search') }}" method="get">
                            <div class="row bm-3">
                                <div class="col-4">
                                    <div class="">
                                        <input class="form-control form-control-sm" type="text" name="text" value="{{ old('text') }}" placeholder="Enter a title, isbn, author ...">
                                    </div>
                                </div>
                            </div>
                            <div class="row bm-3">
                                <!-- <div class="col-sm-12 col-md-4">
                                    <x-input-label for="">Category</x-input-label>
                                    <select class="form-select form-select-sm" name="email_verified">
                                        <option value="">All</option>
                                        <option value="true" if(old('email_verified')=='true' ) selected endif>True</option>
                                        <option value="false" if(old('email_verified')=='false' ) selected endif>False</option>
                                    </select>
                                </div> -->
                                <div class="col-sm-12 col-md-4">
                                    <x-input-label for="">Reviewed</x-input-label>
                                    <select class="form-select form-select-sm" name="reviewed">
                                        <option value="">All</option>
                                        <option value="true" @if(old('reviewed')=='true' ) selected @endif>True</option>
                                        <option value="false" @if(old('reviewed')=='false' ) selected @endif>False</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <x-input-label for="">Added by</x-input-label>
                                    <x-input-text type="date" name="added_by" />
                                </div>
                                <div class="col-sm-12 col-md-3"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 flex justify-end">
                                    <x-button class="primary btn-sm col-sm-12 col-md-3 col-lg-2">Search</x-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row mb-3">
                <h2 class="bm-3">Actions</h2>
                <div class="col-12 d-flex gap-2">
                    @can('create book')
                    <a href="{{ route('admin.books.create') }}" class="btn btn-success xp-3 yp-3">New Book <span class="bi bi-plus"></span></a>
                    @endcan
                </div>
            </div>
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