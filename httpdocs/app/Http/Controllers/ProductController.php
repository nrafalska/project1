<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a listing of all products.
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Show the form for creating a new product.
    public function create()
    {
        return view('products.create');
    }

    // Store a newly created product in the database.
    public function store(Request $request)
    {
        // Validate the incoming request data.
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            // Add other necessary validation rules here.
        ]);

        // Create a new product with the validated data.
        Product::create($validatedData);
        return redirect()->route('products.index');
    }

    // Display the specified product.
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Show the form for editing the specified product.
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update the specified product in the database.
    public function update(Request $request, Product $product)
    {
        // Validate the incoming request data.
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            // Add other necessary validation rules here.
        ]);

        // Update the product with the validated data.
        $product->update($validatedData);
        return redirect()->route('products.index');
    }

    // Remove the specified product from the database.
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    // Display prices for the specified product in various shops.
    public function showPrices(Product $product)
    {
        // Assuming you have a 'prices' relationship defined in the Product model that connects to the Shop model.
        $prices = $product->prices()->with('shop')->get();
        return view('products.prices', compact('product', 'prices'));
    }
}
