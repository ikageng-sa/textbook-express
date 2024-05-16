@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Manage {{ ucfirst($role->name) }} permissions
                    <a class="icon-link icon-link-hover text-decoration-none" onclick="history.back()" style="--bs-icon-link-transform: translate3d(-.125rem, 0, 0); --bs-link-hover-color-rgb: 255, 0, 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                        Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.roles.permit', ['id' => $role->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @session('status')
                        <span class="text-success">{{ session('status') }}</span>
                        @endsession
                        <x-input-error name="permission" :message="$errors->first('permission')" />
                        <div class="row">
                            <x-input-label for="name">{{ __('Permissions') }}</x-input-label>
                            <div class="row flex-wrap mb-3">
                                @forelse($permissions as $permission)
                                <div class="col-4">
                                    <input class="form-check-input" 
                                        type="checkbox" name="permission[]" 
                                        value="{{ $permission->name }}" 
                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} >
                                    <x-input-label for="name">{{ __(ucfirst($permission->name)) }}</x-input-label>
                                </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <x-button class="outline-success btn-sm">Update</x-button>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection