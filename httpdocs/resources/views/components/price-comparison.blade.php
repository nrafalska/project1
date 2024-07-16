{{-- resources/views/livewire/price-comparison.blade.php --}}

@foreach ($products as $product)
    <div class="flex space-x-4 p-2 bg-white shadow rounded-lg">
        <div class="flex-none w-20">
            <!-- Place for product image -->
            <img src="{{ $product->image }}" alt="Product Image" class="w-full h-auto">
        </div>
        <div class="flex-grow">
            <p class="text-sm font-medium">{{ $product->sku }}</p>
            <p class="text-xs text-gray-600">{{ $product->supplier }}</p>
            <p class="text-lg font-bold">{{ $product->name }}</p>
        </div>
        @foreach ($product->prices as $price)
            <div class="flex-none">
                <div class="bg-blue-100 text-blue-800 text-sm font-semibold px-4 py-2 rounded-full">
                    {{ $price->shop->name }}
                </div>
                <p class="text-lg font-bold">{{ $price->amount }} грн</p>
            </div>
        @endforeach
    </div>
@endforeach
