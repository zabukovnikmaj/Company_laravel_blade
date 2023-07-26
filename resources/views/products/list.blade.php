@extends('layout')

@section('content')
    <h1>Products information</h1>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <a href="{{ route('product.create') }}" class="btn btn-primary">New product</a>
    <a href="{{ route('home') }}" class="btn btn-default">Back</a>

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
                    <td>{{ $product?->name }}</td>
                    <td>{{ $product?->description }}</td>
                    <td>{{ $product?->price }}</td>
                    <td>{{ $product?->date }}</td>
                    <td>
                        <img src="{{ $product?->filename }}" alt="product picture"
                             style="max-width: 300px; max-height: 300px">
                    </td>
                    <td>
                        <form action="{{ route('product.delete', ['product' => $product?->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <a href="{{ route('product.edit', ['product' => $product?->id]) }}"
                               class="btn btn-primary btn-sm">Edit</a>
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this product?');">Delete
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
@endsection
