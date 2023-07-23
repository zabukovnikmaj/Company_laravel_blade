@extends('layout')

@section('content')
    <h1>Enter information about the branch office</h1>
    <div class="col-md-12">
        <form
            action="{{ isset($existingData->uuid) ? '/branchOffice/edit/' . $existingData['uuid'] : '/branchOffice/create' }}"
            method="POST">
            @csrf
            @if(isset($existingData['name']))
                @method('PUT')
            @endif

            <x-input
                name="name"
                displayedName="Branch office"
                type="text"
                value="{{ $existingData?->name }}"
            ></x-input>

            <x-input
                name="address"
                displayedName="Branch office address"
                type="text"
                value="{{ $existingData?->address }}"
            ></x-input>

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
