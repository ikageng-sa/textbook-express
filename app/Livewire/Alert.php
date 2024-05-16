<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Alert extends Component
{

    public $flash = null;

    #[On('show-alert')]
    public function render()
    {
        return view('livewire.alert');
    }
}
