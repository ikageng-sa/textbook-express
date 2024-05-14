<div class="d-flex flex-column gap-1">
    @forelse($cart as $book)
    <div class="card p-3" style="min-height:5rem;">
        <table class="">
            <td>
                <img src="{{ isset($book->cover) ? '/'.$book->cover : '/images/no_image.png' }}" alt="" style="height:7em;width:4em;">
            </td>
            <td class="ps-3">
                <h2 class="fs-6 truncate">{{ $book->title }}</h2>
                <div class="d-flex justify-content-between mb-2">
                    <small class="">Edition: {{ $book->edition }}</small>
                    <small class="fw-light"><strong>Condition:</strong> {{ ucfirst($book->condition) }}</small>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <h3>R {{ $book->price }}</h3>
                        <livewire:cart.remove-from-cart :book="$book->order" lazy>
                    </div>

                </div>
            </td>
        </table>
    </div>
    @empty
    <div class="card border-0 p-3 d-flex justify-content-center align-items-center" style="min-height:5rem;background-color:transparent;color:var(--color-dark);">
        <i class="bi bi-box2"></i>&nbsp;Your cart is empty
    </div>
    @endforelse
</div>