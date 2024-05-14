@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row mb-3">

        <a class="icon-link icon-link-hover text-decoration-none" onclick="history.back()" style="--bs-icon-link-transform: translate3d(-.125rem, 0, 0); --bs-link-hover-color-rgb: 255, 0, 0;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg>
            Go Back
        </a>

    </div>
    <div class="row" style="height:80vh;">
        <div class="d-flex justify-content-center align-items-center col-sm-12 col-md-6 col-lg-6">
            <div class="card d-flex justify-content-end p-0 rounded-3 text-start" style="width:15rem;height:20rem;">
                <img src="{{ isset($book->cover) ? '/'.$book->cover : '/images/no_image.png' }}" alt="{{ $book->title }} book cover" class="position-absolute h-100 w-100 rounded-3" style="cursor:pointer;"></img>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="row justify-content-center align-items-center text-center ">
                <div class="row">
                    <h1 class="display-6 my-1">{{ $book->title }}</h1>

                    <p class="lead fs-6 my-1">
                        {{ $book->description }}
                    </p>
                </div>


                <!-- <div class="fs-7 d-flex justify-content-center flex-wrap gap-2 my-1">
                <span class="card bg-danger text-white text-center rounded-pill py-1 px-2 w-auto">
                    Economics
                </span>
                <span class="card bg-primary text-white text-center rounded-pill py-1 px-2 w-auto">
                    Economics
                </span>
                <span class="card bg-warning text-text-dark text-center rounded-pill py-1 px-2 w-auto">
                    Economics
                </span>
            </div> -->

                <div class="row mb-5">
                        <table class="table table-bordered col-12 text-start my-1">
                            <tr>
                                <th scope="row">ISBN</th>
                                <td>{{ $book->isbn }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Author</th>
                                <td>{{ $book->author }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Condition</th>
                                <td>
                                    {{ ucfirst($book->condition) }}
                                </td>
                            </tr>
                        </table>
                </div>

                @if($book->quantity >= 10)
                <div class="row" style="margin-bottom: 10rem;">
                    <div class="card col-sm-18 col-md-6">
                        <div class="card-body">
                            <p class="">
                                There are {{ $book->quantity }} other people selling this books.
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                    <table class="table col-12 table-borderless mb-0">
                        <tr>
                            <th class="text-center fs-5" style="background-color:transparent;">Price</th>
                            <td class="text-center fs-5" style="background-color:transparent;">R {{ $book->price }}</td>
                        </tr>
                    </table>
                <div class="col-12 mb-3">
                        <livewire:cart.add-to-cart :book="$book->slID" class="btn btn-secondary w-100" style="height:4rem; " slot="Cart"/>
                </div>
            </div>
        </div>
    </div>
</div>
<livewire:alert />
@endsection