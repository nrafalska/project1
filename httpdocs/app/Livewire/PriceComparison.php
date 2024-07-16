<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product; // Import your Product model

class PriceComparison extends Component
{
    public function render()
    {
        $products = Product::with('prices.shop')->get(); // Fetch products with related prices and shops

        return view('livewire.price-comparison') // Используйте фактическое имя вашего шаблона Blade
        ->layout('components.layouts.app'); // Обновленный путь к шаблону layout.
    }

}
