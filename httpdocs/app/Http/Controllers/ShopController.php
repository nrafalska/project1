<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // ... existing methods remain unchanged

    /**
     * Display prices for a specific shop across different products.
     * Assumes a 'prices' relationship is defined in the Shop model.
     *
     * @param Shop $shop The shop instance injected by route model binding.
     * @return \Illuminate\View\View
     */
    public function showPrices(Shop $shop)
    {
        // Fetch prices along with associated products
        $prices = $shop->prices()->with('product')->get();

        // Return a view and pass the shop and its prices to it
        // Ensure the 'shops.prices' view is appropriately set up to handle this data
        return view('shops.prices', compact('shop', 'prices'));
    }

    // ... rest of your existing methods remain unchanged
}
