@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    </div>
    <div class="row mb-3">
        <div class="col-12 d-flex gap-2">
            <div class="col-4">
                <form class="" action="{{ route('admin.users.search') }}" method="get">
                    <div class="input-group input-group-sm">
                        <input class="form-control" type="text" name="query" value="{{ $query ?? '' }}" placeholder="Enter an email or name...">
                        <button class="input-group-text btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
            <a href="" class="btn btn-sm btn-success">New user <span class="bi bi-plus"></span></a>
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
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role(s)</th>
                        <th scope="col">Email Verified</th>
                        <th scope="col">Account Status</th>
                        <th scope="col">Date Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $n = 0 @endphp
                    @forelse($users as $user)
                    @php $n++ @endphp
                    <tr>
                        <th scope="row">{{ $n }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="d-flex gap-1">
                            @forelse($user->getRoleNames() as $role)
                            <span class="badge bg-primary">{{ $role }}</span>
                            @empty
                            -
                            @endforelse
                        </td>
                        <td>@isset($user->email_verified_at) <span class="text-success bi bi-check-all"></span> @else <span class="text-danger bi bi-x-lg"></span> @endisset</td>
                        <td>{{ ucfirst($user->status) ?? '-' }}</td>
                        <td>{{ $user->created_at ?? '-' }}</td>
                        <td class="d-flex gap-2">
                        @if (auth()->user()->hasRole('super-admin'))
                            <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-secondary"><span class="bi bi-pen"></span></a>
                        @elseif (auth()->user()->id === $user->id || (auth()->user()->hasRole('admin') && !$user->hasRole('admin')))
                            <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-secondary"><span class="bi bi-pen"></span></a>
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