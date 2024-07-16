<?php

namespace App\Livewire;

use Livewire\Component;

class SomeLivewireComponent extends Component
{
     // If you're using the layout property, it should be like this:
     protected $layout = 'layouts.app';

     public function render()
     {
         // Убедитесь, что путь к вашему виду компонента Livewire указан верно.
         return view('livewire.your-component-view')->layout('components.layouts.app');
     }
     
}
