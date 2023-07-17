<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch office form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
@extends('partials.navBar');

<div class="container mt-5">
    <h1>Enter information about the branch office</h1>
    @php
        if (!isset($err)) {
            $err = [];
        }
    @endphp
    {{ Form::open(array('url' => 'foo/bar')) }}
        <div class="form-group">
            <label for="name">Branch name</label>
            <input type="text" class="form-control {{ isset($err['name']) ? 'is-invalid' : '' }}" name="name"
                   value="{{ old('name', isset($filteredData['name']) ? $filteredData['name'] : '') }}">
            @include('partials.errors', [
                'err' => $err['name'] ?? null
            ])
        </div>

        <div class="form-group">
            <label for="address">Branch address</label>
            <input type="text" class="form-control {{ isset($err['address']) ? 'is-invalid' : '' }}" name="address"
                   value="{{ old('address', isset($filteredData['address']) ? $filteredData['address'] : '') }}">
            @include('partials.errors', [
                'err' => $err['address'] ?? null
            ])
        </div>

        <div class="form-group">
            <label for="products">Products name</label> <br>
            @include('partials.productsCheckbox', [
                'products' => $products,
                'productsData' => is_array($filteredData['products']) ? $filteredData['products'] : explode(',', $filteredData['products'])
            ])
            @include('partials.errors', [
                'err' => $err['products'] ?? null
            ])
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="/branchOffice/list/" class="btn btn-default" style="margin-left: 10px">Back</a>
    {{ Form::close() }}
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
