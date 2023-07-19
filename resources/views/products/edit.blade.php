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
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($filteredData['uuid']) ? '/products/edit/' . $filteredData['uuid'] : '/products/create' }}"  method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($filteredData['name']))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Product name</label><br>
            <input type="text" class="form-control" name="name"
                   value="{{ isset($filteredData['name']) ? $filteredData['name'] : '' }}">
            @include('partials.errors', [
                'err' => $err['name'] ?? null
            ])
        </div>

        <div class="form-group">
            <label for="description">Product description</label><br>
            <textarea class="form-control" name="description" cols="50"
                      rows="4">{{ isset($filteredData['description']) ? $filteredData['description'] : '' }}</textarea>
            @include('partials.errors', [
                'err' => $err['description'] ?? null
            ])
        </div>

        <div class="form-group">
            <label for="price">Product price</label><br>
            <input type="number" class="form-control" name="price" step="0.01" min="0" max="10000"
                   value="{{ isset($filteredData['price']) ? $filteredData['price'] : '' }}">
            @include('partials.errors', [
                'err' => $err['price'] ?? null
            ])
        </div>

        <div class="form-group">
            <label for="deliveryDate">Product delivery date</label><br>
            <input type="date" class="form-control" name="deliveryDate"
                   value="{{ isset($filteredData['date']) ? $filteredData['date'] : '' }}">
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

            @php
                $filename = \Illuminate\Support\Facades\Storage::files('public/productImages/' . $filteredData->uuid);
                if(count($filename) === 0){
                    $filename = [''];
                }
            @endphp
            <img src="{{ \Illuminate\Support\Facades\Storage::url($filename[0]) }}"
                 alt="Product picture has not been uploaded yet!" style="max-width: 300px; max-height: 300px">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="/products/list/" class="btn btn-default" style="margin-left: 10px">Back</a>
    </form>

</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
