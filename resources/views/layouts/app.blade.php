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
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @livewireStyles

    <style>
        [data-initials]:before {
            background: #099bdd;
            color: white;
            opacity: 1; 
            content: attr(data-initials); 
            display: inline-block; 
            font-weight: bold; 
            border-radius: 50%; 
            vertical-align: middle; 
            width: 35px; 
            height: 35px; 
            line-height: 35px; 
            text-align: center; 
        }

        .fs-sm {
            font-size: .75rem;
        }

        .dp-link-group ul {
            padding: 0;
            width: 100%;
            border: 1px solid lightgray;
            border-radius: .25rem;
        }

        .dp-link-group ul li a {
            color: #1e1e1e;
            text-decoration: none;
            padding-left: .25rem;
            width: 100% !important;
        }

        .dp-link-group ul li {
            width: 100%;
            list-style-type: none;
            padding: .30rem 0 .30rem 0;
            border-top: 1px solid lightgray;
            cursor: pointer;
        }

        .dp-link-group ul li:hover {
            background-color: lightgray;
        }

        .dp-link-group ul:first-child {
            border-top: none;
        }

        ;

        .dp-link-group ul:last-child {
            border-bottom: none;
        }

        .book-card {
            display: flex;
            flex-direction: row;
        }

        @media only screen and (max-width:576px) {
            .book-card .card-image {
                display: flex;
                justify-content: center;
            }

            .book-card {
                justify-content: center;
                flex-direction: column !important;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        
    <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="/images/logo.png" alt="Textbook express logo" class="" style="height:5rem;">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @guest
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navtoggle" aria-controls="navtoggle" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navtoggle">
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
                    <form class="mt-2" action="{{ route('search') }}" method="get">
                        <div class="input-group input-group-sm mb-3">
                            <input class="form-control" type="text" name="query" value="{{ $query ?? '' }}" placeholder="Enter Title or ISBN...">
                            <button class="input-group-text btn btn-primary" type="submit" name="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                @endguest
                @auth
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navtoggle" aria-controls="navtoggle" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navtoggle">
                        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 col-md-6 d-flex justify-content-evenly">
                            <li class="nav-item">
                                <x-nav-link route="home">Home</x-nav-link>
                            </li>
                            <li class="nav-item">
                                <x-nav-link route="sell">Sell</x-nav-link>
                            </li>
                            @role(['admin'])
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Admin</a>
                                <ul class="dropdown-menu">
                                    @role(['super-admin'])
                                    <li class="dropdown-item">
                                        <a href="{{ route('admin.roles.index') }}" class="nav-link">Roles</a>
                                    </li>
                                    @endrole

                                    <li class="dropdown-item">
                                        <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="{{ route('admin.books.index') }}" class="nav-link">Books</a>
                                    </li>
                                </ul>
                            </li>
                            @endrole
                        </ul>
                        @php 
                            $expr = '/(?<=\s|^)[a-z]/i';
                            preg_match_all($expr, auth()->user()->name, $matches);
                            $result = implode('', $matches[0]);
                            $initials = strtoupper($result);  
                        @endphp
                        <a href="{{ route('general.profile.index') }}" ><div data-initials="{{ $initials }}"></div></a>
                    </div>
                @endauth
            </div>
    </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @livewireScripts
</body>
</html>
