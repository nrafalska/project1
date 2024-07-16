<?php

namespace App\Livewire;

use Livewire\Component;

class SomeLivewireComponent extends Component
{
    public function render()
    {
        return view('livewire.some-livewire-component')
        ->layout('components.layouts.app'); // Обновленный путь к шаблону layout.
    }

}
