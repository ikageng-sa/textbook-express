<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])

    <style>
        a {
            color: inherit;
            text-decoration: none;
        }

        

        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: #fff;
            border-radius: 50%;
            width: auto;
            height: auto;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg">
            <div class="container d-flex justify-content-between align-items-center">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navtoggle" aria-controls="navtoggle" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <img src="/images/logo.png" alt="Textbook express logo" class="" style="height:3rem;">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @guest
                @if (Route::has('login') && Route::has('register'))
                <div class="ms-sm-0 ms-lg-5 mb-2">
                    <a href="{{ route('start') }}" class="btn btn-success">Start Now</a>
                </div>
                @endif<div class="collapse navbar-collapse" id="navtoggle">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 col-md-6 d-flex justify-content-evenly">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('welcome') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                    <form class="mt-2" action="{{ route('general.book.search') }}" method="get">
                        <div class="input-group input-group-sm mb-3">
                            <input class="form-control" type="text" name="query" value="{{ $query ?? '' }}" placeholder="Enter Title or ISBN...">
                            <button class="input-group-text btn btn-primary" type="submit" name="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                @endguest
                @auth
                <div class="d-flex flex-row gap-3 align-items-center">
                    <livewire:cart.cart lazy />
                    <livewire:account lazy />
                </div>
                <div class="collapse navbar-collapse" id="navtoggle">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 col-md-6 d-flex justify-content-evenly">
                        <li class="nav-item">
                            <x-nav-link route="general.home">Home</x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link route="general.book.show-sell-form">Sell</x-nav-link>
                        </li>
                        @role(['admin', 'super-admin'])
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Admin</a>
                            <ul class="dropdown-menu">
                                @can('view role')
                                <li class="dropdown-item">
                                    <a href="{{ route('admin.roles.index') }}" class="nav-link">Roles</a>
                                </li>
                                @endcan
                                @can('view user')
                                <li class="dropdown-item">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
                                </li>
                                @endcan
                                @can('view book')
                                <li class="dropdown-item">
                                    <a href="{{ route('admin.books.index') }}" class="nav-link">Books</a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endrole
                    </ul>
                </div>
                @endauth
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>