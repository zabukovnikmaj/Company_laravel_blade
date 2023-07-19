@php
    if (empty($productsData)) {
        $productsData = [];
    }
@endphp

@if (isset($products) && !empty($products))
    @foreach ($products as $product)
        <label>
            <input type="checkbox" name="products[]" value="{{ $product->uuid }}"
                {{ in_array($product->uuid, $productsData) ? 'checked' : '' }}>
            {{ $product['name'] }}
        </label><br>
    @endforeach
@else
    <div>No products have been entered yet!</div>
@endif
<br>
