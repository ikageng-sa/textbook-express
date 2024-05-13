<?php

namespace App\Livewire;

use Livewire\Component;

class Account extends Component
{
    public function render()
    {

        $initials = '';
        $names = explode(' ', auth()->user()->name);
        if (count($names) > 1) {
            $initials = strtoupper(substr($names[0], 0, 1) . substr($names[1], 0, 1));
        } else {
            $names = implode(' ', $names);
            preg_match_all('#([A-Z]+)#', $names, $capitals);
            if (count($capitals[1]) >= 2) {
                $initials = mb_substr(implode('', $capitals[1]), 0, 2, 'UTF-8');
            }
        }
        return view('livewire.account', [
            'initials' => $initials,
        ]);
    }
}
