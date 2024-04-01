
    <a href={{ $link ?? '#' }} class="book-cont" 
        @isset($preventDefault) onclick="event.preventDefault();"@endisset 
        @isset($wire) wire:click={{ $wire }} @endisset>

        <img 
            src="{{ !empty($source) ? $source : '/images/no_image.png' }}" 
            alt="{{ $title }} book cover" >
            
        <div class="fs-sm text-center">
            <p class="truncate mb-0">{{ $title }}</p>

            @isset($details)
                <p class="fw-bold">{{ $price ?? '' }}</p>
            @endisset

        </div>

    </a>