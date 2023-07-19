<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .alert {
            margin-top: 10px;
        }
    </style>
</head>
<body>
@extends('partials.navBar');

<div class="container">
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

                <div class="form-group">
                    <label for="name">Employee name</label><br>
                    <input type="text" class="form-control" name="name"
                           value="{{ old('name', isset($filteredData['name']) ? $filteredData['name'] : '') }}">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="position">Employee position</label><br>
                    <input type="text" class="form-control" name="position"
                           value="{{ old('position', isset($filteredData['position']) ? $filteredData['position'] : '') }}">
                    @error('position')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="age">Employee age</label><br>
                    <input type="number" class="form-control" name="age" step="1" min="15" max="100"
                           value="{{ old('age', isset($filteredData['age']) ? $filteredData['age'] : '') }}">
                    @error('age')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Employee sex:</label><br>
                    <input type="radio" name="sex" value="m" {{ $filteredData['sex'] === 'm' ? 'checked' : '' }}>
                    <label for="male">Male</label><br>
                    <input type="radio" name="sex" value="f" {{ $filteredData['sex'] === 'f' ? 'checked' : '' }}>
                    <label for="female">Female</label>
                    @error('sex')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Employee email</label>
                    <input type="email" class="form-control"
                           name="email"
                           value="{{ old('email', isset($filteredData['email']) ? $filteredData['email'] : '') }}">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="/employees/list/" class="btn btn-default" style="margin-left: 10px">Back</a>
            </form>
        </div>
    </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
