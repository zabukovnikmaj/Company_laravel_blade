@extends('layout')

@section('content')
    <h1>Enter information about the products</h1>
    <form action="{{ isset($filteredData['uuid']) ? '/products/edit/' . $filteredData['uuid'] : '/products/create' }}"  method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($filteredData['name']))
            @method('PUT')
        @endif

        <x-input
            name="name"
            displayedName="Product name"
            type="text"
            value="{{ $filteredData?->name }}"
        ></x-input>

        <div class="form-group">
            <label for="description">Product description</label><br>
            <textarea class="form-control" name="description" cols="50"
                      rows="4">{{ old('description', $filteredData?->description) }}</textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <x-input
            name="price"
            displayedName="Product price"
            type="number"
            value="{{ $filteredData?->price }}"
        ></x-input>

        <x-input
            name="deliveryDate"
            displayedName="Product delivery date"
            type="date"
            value="{{ $filteredData?->date }}"
        ></x-input>

        <div class="form-group">
            <label for="productFile">Product picture</label><br>
            <input type="file" class="form-control-file" name="productFile" id="productFile">
            @error('productFile')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
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
@endsection
