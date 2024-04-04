@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Create Roles
                    <a class="icon-link icon-link-hover text-decoration-none" onclick="history.back()" style="--bs-icon-link-transform: translate3d(-.125rem, 0, 0); --bs-link-hover-color-rgb: 255, 0, 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                        Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.roles.store') }}" method="post">
                        @csrf
                        @session('status')
                        <span class="text-success">{{ session('status') }}</span>
                        @endsession
                        <div class="row">
                            <x-input-label for="name">{{ __('Role Name') }}</x-input-label>
                            <div class="input-group">
                                <x-input-text name="name" class=" form-control form-control-sm border-success-subtle" value="{{ old('name') }}" />
                                <x-button class="outline-success btn-sm input-group-text">Save</x-button>
                            </div>
                            <x-input-error name="name" :message="$errors->first('name')" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection