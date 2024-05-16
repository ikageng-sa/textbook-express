@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-sm-12 col-md-8">
            <div class="card">
                <div class="row p-2">
                    <div class="card-body">
                        <h2 class="mb-3">Advanced Search</h2>
                        <div class="col-sm-12 col-md-8">
                            <form action="{{ route('admin.users.search') }}" method="get">
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="">
                                            <input class="form-control form-control-sm" type="text" name="text" value="{{ old('text') }}" placeholder="Enter an email or name...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-md-4">
                                        <x-input-label for="">Status</x-input-label>
                                        <select class="form-select form-select-sm" name="status">
                                            <option value="">All</option>
                                            @foreach($accountStatuses as $status)
                                            <option value="{{ $status }}" @if(old('status')==$status) selected @endif>{{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <x-input-label for="">Email verified</x-input-label>
                                        <select class="form-select form-select-sm" name="email_verified">
                                            <option value="">All</option>
                                            <option value="true" @if(old('email_verified')=='true' ) selected @endif>True</option>
                                            <option value="false" @if(old('email_verified')=='false' ) selected @endif>False</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <x-input-label for="">Created by</x-input-label>
                                        <x-input-text type="date" name="created_by" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex justify-content-end">
                                        <x-button class="primary btn-sm col-sm-12 col-md-3 col-lg-2">Search</x-button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row mb-3">
        <h2>Actions</h2>
        <div class="col-12 d-flex gap-2">
            <a href="" class="btn btn-sm btn-success">New user <span class="bi bi-plus"></span></a>
        </div>
    </div> -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ $pageTitle }}
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="desktop hidden" scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th  scope="col">Role(s)</th>
                                <th class="desktop hidden" scope="col" class="center-text">Email Verified</th>
                                <th class="desktop hidden" scope="col">Account Status</th>
                                <th class="desktop hidden" scope="col">Date Created</th>
                                <th class="desktop hidden"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $n = 0 @endphp
                            @forelse($users as $user)
                            @php $n++ @endphp
                            <tr>
                                <th class="desktop hidden" scope="row">{{ $n }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="d-flex gap-1">
                                    @forelse($user->getRoleNames() as $role)
                                    <span class="badge bg-primary">{{ $role }}</span>
                                    @empty
                                    <span class="badge bg-primary">user</span>
                                    @endforelse
                                </td>
                                <td class="desktop hidden" class="center-text">@isset($user->email_verified_at) <span class="text-success bi bi-check-all"></span> @else <span class="text-danger bi bi-x-lg"></span> @endisset</td>
                                <td class="desktop hidden">{{ ucfirst($user->status) ?? '-' }}</td>
                                <td class="desktop hidden">{{ $user->created_at ?? '-' }}</td>
                                <td class="desktop hidden gap-2">
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
    </div>
</div>
@endsection