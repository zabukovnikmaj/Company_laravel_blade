<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List products</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
@extends('partials.navBar');

<div class="container">
    <h1>Products information</h1>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <a href="{{ url('/products/create') }}" class="btn btn-primary">New product</a>
    <a href="{{ url('/') }}" class="btn btn-default">Back</a>

    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Delivery date</th>
            <th>Product picture</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @if (count($products) > 0)
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['description'] }}</td>
                    <td>{{ $product['price'] }}</td>
                    <td>{{ $product['date'] }}</td>
                    <td>
                        @php
                        $filename = \Illuminate\Support\Facades\Storage::files('public/productImages/' . $product->uuid);
						if(count($filename) === 0){
							$filename = [''];
						}
                        @endphp
                        <img src="{{ Storage::url($filename[0]) }}" alt="product picture"
                             style="max-width: 300px; max-height: 300px">
                    </td>
                    <td>
                        <form action="{{ url('/products/delete', $product['uuid']) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <a href="{{ url('/products/edit', $product['uuid']) }}"
                               class="btn btn-primary btn-sm">Edit</a>
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Confirm?');">Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6">No products found!</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
