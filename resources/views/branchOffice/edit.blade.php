@extends('layout')

@section('content')
    <h1>Enter information about the branch office</h1>
    <div class="col-md-12">
        <form
            action="{{ isset($filteredData['uuid']) ? '/branchOffice/edit/' . $filteredData['uuid'] : '/branchOffice/create' }}"
            method="POST">
            @csrf
            @if(isset($filteredData['name']))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Branch name</label>
                <input type="text" class="form-control {{ isset($err['name']) ? 'is-invalid' : '' }}" name="name"
                       value="{{ old('name', isset($filteredData['name']) ? $filteredData['name'] : '') }}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Branch address</label>
                <input type="text" class="form-control {{ isset($err['address']) ? 'is-invalid' : '' }}" name="address"
                       value="{{ old('address', isset($filteredData['address']) ? $filteredData['address'] : '') }}">
                @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="products">Products name</label> <br>
                @include('partials.productsCheckbox', [
                    'products' => $products,
                    'productsData' => $productsData,
                ])
                @error('products')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="/branchOffice/list/" class="btn btn-default" style="margin-left: 10px">Back</a>
        </form>
@endsection
