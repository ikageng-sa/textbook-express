
<div class="">
    @if(session()->has('alert'))
        <div wire:transition.in.origin.bottom class="w-50 alert alert-dark position-fixed bottom-0 start-50 translate-middle">
            {{ session('alert') }}
        </div>
    @endif

    @script()
    $(document).ready(function() {
        window.livewire.on['show-alert'], ()=>{
            setTimeout(function(){
                $('.alert').fadeOut('fast');
            }, 5000)
        }
    })
    @endscript
</div>
