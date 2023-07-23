@extends('layout')

@section('content')
    <h1>Enter information about the employee</h1>
    @php
        if (!isset($err)) {
            $err = [];
        }
    @endphp
    <div class="row">
        <div class="col-md-12">
            <form action="{{ isset($filteredData['uuid']) ? '/employees/edit/' . $filteredData['uuid'] : '/employees/create' }}" method="POST">
                @csrf
                @if(isset($filteredData['name']))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="branch_office">Branch office name</label><br>
                    @include('partials.branchNameRadioButtons', [
                        'branchOffices' => $branchOffices,
                        'existingBranchOfficeUuid' => isset($filteredData->branchOffice->uuid) ? $filteredData->branchOffice->uuid : ''
                    ])
                    @error('branch_office')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <x-input
                    name="name"
                    displayedName="Employee name"
                    type="text"
                    value="{{ $filteredData?->name }}"
                ></x-input>

                <x-input
                    name="position"
                    displayedName="Employee position"
                    type="text"
                    value="{{ $filteredData?->position }}"
                ></x-input>

                <x-input
                    name="age"
                    displayedName="Employee age"
                    type="number"
                    value="{{ $filteredData?->age }}"
                ></x-input>

                <div class="form-group">
                    <label>Employee sex</label><br>
                    <input type="radio" name="sex" value="m" {{ $filteredData?->sex === 'm' ? 'checked' : '' }}>
                    <label for="male">Male</label><br>
                    <input type="radio" name="sex" value="f" {{ $filteredData?->sex === 'f' ? 'checked' : '' }}>
                    <label for="female">Female</label>
                    @error('sex')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <x-input
                    name="email"
                    displayedName="Employee email"
                    type="email"
                    value="{{ $filteredData?->email }}"
                ></x-input>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="/employees/list/" class="btn btn-default" style="margin-left: 10px">Back</a>
            </form>
        </div>
    </div>
@endsection
