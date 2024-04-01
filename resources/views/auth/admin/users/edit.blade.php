@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ $user->name }}'s roles
                    <a class="icon-link icon-link-hover text-decoration-none" onclick="history.back()" style="--bs-icon-link-transform: translate3d(-.125rem, 0, 0); --bs-link-hover-color-rgb: 255, 0, 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                        Back
                    </a>
                </div>
                <div class="card-body">
                @if($user->name !== auth()->user()->name && auth()->user()->hasRole('super-admin'))
                    <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @session('status')
                        <span class="text-success">{{ session('status') }}</span>
                        @endsession
                        <div class="row">
                            <div class="col-12 mb-3">
                                <x-input-label for="publication_date">{{ __('Select a role(s)') }}</x-input-label>
                                <select autocomplete="off" class="form-select" name="roles[]" multiple>
                                    <option value="">Select a role</option>
                                    @forelse($roles as $role)
                                        <option value="{{ $role }}" {{ in_array($role, $userRoles) ? 'selected' : '' }}>{{ ucFirst($role) }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <x-input-error name="publication_date" :message="$errors->get('publication_date')" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <x-button class="outline-success btn-sm">Update</x-button>
                            </div>
                        </div>
                    </form>
                @else 
                <div class="d-flex gap-1">
                    @forelse($user->getRoleNames() as $role)
                            <span class="badge bg-primary">{{ $role }}</span>
                    @empty
                    <span class="badge bg-primary">user</span>
                    @endforelse
                </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection