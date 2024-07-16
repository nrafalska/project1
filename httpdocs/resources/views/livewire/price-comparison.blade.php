<div>
    <!-- Сравнение цен -->
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Shop</th>
                <!-- Другие заголовки колонок -->
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->shop->name }}</td>
                    <!-- Другие данные продукта -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
