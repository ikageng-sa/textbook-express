@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    </div>
    <div class="row mb-3">
        <div class="col-12 d-flex gap-2">
            <!-- <div class="col-4">
                <form class="" action="" method="get">
                    <div class="input-group input-group-sm">
                        <input class="form-control" type="text" name="query" value="{{ $query ?? '' }}" placeholder="Enter an email or name...">
                        <button class="input-group-text btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div> -->
            
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            Permissions
            @can('create permission')
            <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-success">Add Permission <span class="bi bi-plus"></span></a>
            @endcan
        </div>
        <div class="card-body">
            @session('status')
                <span class="text-success">{{ session('status') }}</span>
            @endsession
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Permission</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 0 @endphp
                    @forelse($permissions as $permission)
                    @php $n++ @endphp
                    <tr>
                        <th scope="row">{{ $n }}</th>
                        <td>{{ ucfirst($permission->name) }}</td>
                        <td class="d-flex gap-2">
                            @can('update permission')
                            <a href="{{ route('admin.permissions.edit', ['permission' => $permission->id]) }}" class="btn btn-sm btn-info"><span class="bi bi-pen"></span></a>
                            @endcan
                            @can('delete permission')
                            <a href="{{ route('admin.permissions.destroy', ['id' => $permission->id]) }}" class="btn btn-sm btn-danger"><span class="bi bi-trash"></span></a>
                            @endcan
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection