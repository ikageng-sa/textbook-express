<div>
    <i class="bi bi-cart fs-1 position-relative">
        @if($items)
        <i class=" position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-warning" style="font-size:.5em;">
            {{ $items }}
        </i>
        @endif
    </i>
</div>