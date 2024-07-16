<?php

namespace App\Filament\Resources\PriceResource\Pages;

use Filament\Pages\Actions\CreateAction; // Correct namespace for CreateAction
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PriceResource;
use App\Models\Product; // Make sure the Product model is imported
use Illuminate\Contracts\View\View; // Import the View contract

class ListPrices extends ListRecords
{
    protected static string $resource = PriceResource::class;

    // Make sure to use the correct namespace for the CreateAction
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    // This method needs to be compatible with the parent render method.
    // If you want to include a Livewire component on the page, you might not
    // need to use the `render` method directly. Instead, you can include it in the view.
    public function render(): View
    {
        // Fetch products with related prices and shops
        // and pass them to the view.
        $products = Product::with('prices.shop')->get();

        // The view path must match the actual path of your Blade file.
        // For example, if your Blade file is located at `resources/views/filament/price-resource/pages/list-prices.blade.php`,
        // then the view should be `filament.price-resource.pages.list-prices`.
        // Adjust the path as necessary based on your actual directory structure.
        return view('filament.price-resource.pages.list-prices', [
            'products' => $products,
        ]);
    }
}
