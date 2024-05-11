@props(['details', 'route'])
<?php 
?>
<a href="{{ $route }}" class="book-container">
    <div class="book-cover text-light mb-2">
        <img src="/{{ $details->cover ? $details->cover : images/no_image }}" alt="{{ $details->title }} book cover">
    </div>
    <div class="book-details">
        <h3 class="title text-center fs-am-6 fs-md-auto truncate">{{ $details->title }}</h3>
        <p class="sub-title truncate text-center">{{ $details->author ?? '' }}</p>
        <p class="price text-end">R {{ $details->price }}</p>
    </div>
</a>