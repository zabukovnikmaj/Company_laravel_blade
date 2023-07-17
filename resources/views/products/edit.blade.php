<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
@extends('partials.navBar');

<div class="container">
    <h1>Enter information about the products</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $field => $error)
                    <li>{{ $field }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/products/create" method="POST">
        @csrf
        @if(isset($filteredData['name']))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Product name</label><br>
            <input type="text" class="form-control" name="name"
                   value="{{ old('name', isset($filteredData['name']) ? $filteredData['name'] : '') }}">
            @include('partials.errors', [
                'err' => $err['name'] ?? null
            ])
        </div>

        <div class="form-group">
            <label for="description">Product description</label><br>
            <textarea class="form-control" name="description" cols="50"
                      rows="4">{{ old('description', isset($filteredData['description']) ? $filteredData['description'] : '') }}</textarea>
            @include('partials.errors', [
                'err' => $err['description'] ?? null
            ])
        </div>

        <div class="form-group">
            <label for="price">Product price</label><br>
            <input type="number" class="form-control" name="price" step="0.01" min="0" max="10000"
                   value="{{ old('price', isset($filteredData['price']) ? $filteredData['price'] : '') }}">
            @include('partials.errors', [
                'err' => $err['price'] ?? null
            ])
        </div>

        <div class="form-group">
            <label for="deliveryDate">Product delivery date</label><br>
            <input type="date" class="form-control" name="deliveryDate"
                   value="{{ old('deliveryDate', isset($filteredData['date']) ? $filteredData['date'] : '') }}">
            @include('partials.errors', [
                'err' => $err['deliveryDate'] ?? null
            ])
        </div>

        <div class="form-group">
            <label for="productFile">Product picture</label><br>
            <input type="file" class="form-control-file" name="productFile" id="productFile">
            @include('partials.errors', [
                'err' => $err['productFile'] ?? null
            ])
            <br>
            <img src="/products/images/{{ $filteredData['uuid'] }}"
                 alt="Product picture has not been uploaded yet!" style="max-width: 300px; max-height: 300px">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="/products/list/" class="btn btn-default" style="margin-left: 10px">Back</a>
    </form>

</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
