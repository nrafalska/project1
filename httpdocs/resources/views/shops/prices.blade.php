{{-- resources/views/products/prices.blade.php --}}

@extends('components.layouts.app')

@section('content')
<div class="container">
    <h1>Prices for {{ $product->name }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Shop Name</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prices as $price)
                <tr>
                    <td>{{ $price->shop->name }}</td>
                    <td>${{ number_format($price->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
