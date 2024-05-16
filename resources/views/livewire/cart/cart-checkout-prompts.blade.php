<div>
    @if($hasItems)
    <a href="{{ route('checkout') }}" class="btn btn-secondary col-12 d-flex align-items-center justify-content-center" style="height:4rem;">Proceed to checkout</a>
    @else
    <a href="{{ route('general.book.search') }}" class="btn btn-info col-12 d-flex align-items-center justify-content-center" style="height:4rem;"><i class="bi bi-search"></i>&nbsp;Find a book you might like</a>
    @endif
</div>
