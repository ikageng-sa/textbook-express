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
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-info">Permissions</a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-warning">Users</a>
            
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            Roles
            <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-success">Add role <span class="bi bi-plus"></span></a>
        </div>
        <div class="card-body">
            @session('status')
                <span class="text-success">{{ session('status') }}</span>
            @endsession
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 0 @endphp
                    @forelse($roles as $role)
                    @php $n++ @endphp
                    <tr>
                        <th scope="row">{{ $n }}</th>
                        <td>{{ ucfirst($role->name) }}</td>
                        <td class="d-flex gap-2">
                            @if($role->name !== 'super-admin')
                            <a href="{{ route('admin.roles.manage', ['id' => $role->id]) }}" class="btn btn-sm btn-secondary"><span class="bi bi-card-checklist"></span></a>
                            <a href="{{ route('admin.roles.edit', ['role' => $role->id]) }}" class="btn btn-sm btn-info"><span class="bi bi-pen"></span></a>
                            <a href="{{ route('admin.roles.destroy', ['id' => $role->id]) }}" class="btn btn-sm btn-danger"><span class="bi bi-trash"></span></a>
                            @endif
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