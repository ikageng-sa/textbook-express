<div>
    @if($selectedBook)
    <input type="hidden" name="book" value="{{ $selectedBook->id }}">
    <div class="mb-3">
        <div class="card d-flex flex-sm-column flex-md-row border-success-subtle p-4" style="min-height:15rem;">
            <div wire:click="unsetBook()" class="btn btn-danger p-0 m-0 d-flex justify-content-center align-items-center" style="position:absolute;top:15px;right:15px;cursor:pointer;height:2.25rem;width:2rem;">
                <span class="bi bi-x fs-2"></span>
            </div>
            <img src="{{ isset($selectedBook->cover) ? '/'.$selectedBook->cover : '/images/no_image.png' }}" alt="" class="h-auto w-auto">
            <div class="card-body d-flex flex-column gap-0">
                <h5 class="card-title my-0">{{ $selectedBook->title }}</h5>
                <small class="fs-sm text-secondary">{{ $selectedBook->category }}</small>
                <p class="card-text my-0">Author(s):<br>{{ $selectedBook->author }}</p>
                <small class="">{{ $selectedBook->description }}</small>
            </div>
        </div>
    </div>
</div>
@else
<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <div class="dropdown-datalist">
        <input wire:model.live="query" id="title" placeholder="Type to search..." class="form-control border-success-subtle" required autocomplete="off">
        @if(!empty($query))
        <div class="datalist list-group">
            @forelse($results as $result)
            <a onclick="event.preventDefault()" wire:click="bookSelected({{ $result->id }})" 
                class="datalist-item list-group-item list-group-item-action">{{ $result->title }}</a>
            @empty
            <li>
                <a href="{{ route('book.create') }}">
                    {{ __('Create') }}
                </a>
            </li>
            @endforelse
        </div>
        @endif
    </div>
</div>
@endif
</div>