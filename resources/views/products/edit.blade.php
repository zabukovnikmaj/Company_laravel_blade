@extends('layout')

@section('content')
    <h1>Enter information about the products</h1>
    <form action="{{ isset($existingData->id) ? route('product.edit', ['product' => $existingData->id]) : route('product.create') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if(isset($existingData->name))
            @method('PUT')
        @endif

        <x-input
            name="name"
            displayedName="Product name"
            type="text"
            value="{{ $existingData?->name }}"
        ></x-input>

        <div class="form-group">
            <label for="description">Product description</label><br>
            <textarea class="form-control" name="description" cols="50"
                      rows="4">{{ old('description', $existingData?->description) }}</textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <x-input
            name="price"
            displayedName="Product price"
            type="number"
            value="{{ $existingData?->price }}"
        ></x-input>

        <x-input
            name="deliveryDate"
            displayedName="Product delivery date"
            type="date"
            value="{{ $existingData?->date }}"
        ></x-input>

        <div class="form-group">
            <label for="productFile">Product picture</label><br>
            <input type="file" class="form-control-file" name="productFile" id="productFile">
            @error('productFile')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>

            <img src="{{ $existingData?->filename }}"
                 alt="Product picture has not been uploaded yet!" style="max-width: 300px; max-height: 300px">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('product.list') }}" class="btn btn-default" style="margin-left: 10px">Back</a>
    </form>
@endsection
