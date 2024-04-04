@extends('layouts.app')

@section('content')
<section class="container">
    <div class="row flex-sm-column flex-md-row" style="min-height:90vh;">
        <div class="d-flex justify-content-center align-items-center h-100 col-sm-12 col-md-6 col-lg-6">
            <div class="py-5">
                <p class="display-4">
                    Buy secondhand <span class="text-info">textbooks</span> directly from a seller at an <span class="text-info">affordable</span> price.
                </p>
                <p class="lead fs-5">
                    It's easy: find a book you like, and it's yours in just one step.
                </p>
                <div class="d-flex justify-content-between gap-3 ">
                    <a href="#" class="btn btn-outline-success rounded col">About Us</a>
                    <a href="{{ route('start') }}" class="btn btn-success rounded col">Start Now</a>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center h-100 col-sm-12 col-md-6 col-lg-6">
            <img class="w-100 h-auto" src="images/modern_study.jpg" alt="Illustration of a kid studying">
        </div>
    </div>
</section>

<section class="container">
    <div class="row d-flex justify-content-center align-items center">
        <div class="text-center w-75 col-12">
            <figure class="text-center">
                <blockquote class="blockquote">
                    <p class="lead fs-4">Education is the passport to the future, for tomorrow belongs to those who prepare for it today.</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    <cite title="Source Title">Malcolm X</cite>
                </figcaption>
            </figure>
        </div>
    </div>
</section>

<section class="container">
    <div class="row min-vh-100">
        <h1 class="disiplay-6 mt-5 mb-0 pb-0">
            Acquire Your Textbook in
            <span class="text-success">3 Simple Steps</span>
        </h1>
        <p class="lead fs-6 my-0 py-0">
            Experience the simplicity of acquiring your next textbook with our efficient 3-step process. Get your book
            hassle-free and dive into learning in no time!
        </p>

        <div class="mt-0 pt-0col-12 d-flex flex-wrap gap-2" style="min-height:20rem;">
            <div class="card p-1 justify-content-center text-center col-sm-12 col-md-4">
                <i class="fs-1 bi bi-search"></i>
                <h5 class="lead">Browse</h5>
                <p class="lead fs-6">
                    Explore our extensive collection of secondhand textbooks and find the ones that match your needs and interests.
                </p>
            </div>
            <div class="card p-1 justify-content-center text-center col-sm-12 col-md-4">
                <i class="fs-1 bi bi-bag"></i>
                <h5 class="lead">Select</h5>
                <p class="lead fs-6">
                    Choose the textbooks you want to purchase and add them to your cart with just a few clicks.
                </p>
            </div>
            <div class="card p-1 flex-column justify-content-center text-center col-sm-12 col-md-4">
                <i class="fs-1 bi bi-bag-check"></i>
                <h5 class="lead">Checkout</h5>
                <p class="lead fs-6">
                    Complete your purchase securely and conveniently, and get ready to receive your books quickly and affordably.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection