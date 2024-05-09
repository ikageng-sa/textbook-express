@props(['details', 'route'])
<?php 
?>
<a href="{{ $route }}" class="book-container">
    <div class="book-cover d-flex justify-content-center align-items-end text-light pb-3">
        <img src="/{{ $details->cover ? $details->cover : images/no_image }}" alt="" style="height:100%; width:100%;">
    </div>
    <div class="book-details">
        <h3 class="title text-center truncate">{{ $details->title }}</h3>
        <p class="sub-title truncate text-center">{{ $details->author ?? '' }}</p>
        <p class="price text-end">R {{ $details->price }}</p>
    </div>
</a>