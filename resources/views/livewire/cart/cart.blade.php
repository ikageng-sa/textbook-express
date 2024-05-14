<div>
    <a style="color:var(--color-dark);" href="{{ route('general.cart.index') }}">
        <i class="bi bi-cart fs-1 position-relative">
            @if($items)
            <i class="position-absolute translate-middle badge rounded-pill text-bg-warning" style="top:0;left:100%;font-size:.75rem;">
                {{ $items }}
            </i>
            @endif
        </i>
    </a>
</div>
