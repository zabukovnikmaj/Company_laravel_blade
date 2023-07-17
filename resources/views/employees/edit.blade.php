<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/employees/create" method="POST">
                @csrf
                @if(isset($filteredData['name']))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="branchOffice">Branch office name</label><br>
                    @include('partials.branchNameRadioButtons', [
                        'branchOffices' => $branchOffices,
                        'existingBranchOffice' => $filteredData['branchOffice']
                    ])
                    @include('partials.errors', [
                        'err' => $err['branchOffice'] ?? null
                    ])
                </div>

                <div class="form-group">
                    <label for="name">Employee name</label><br>
                    <input type="text" class="form-control" name="name"
                           value="{{ old('name', isset($filteredData['name']) ? $filteredData['name'] : '') }}">
                    @include('partials.errors', [
                        'err' => $err['name'] ?? null
                    ])
                </div>

                <div class="form-group">
                    <label for="position">Employee position</label><br>
                    <input type="text" class="form-control" name="position"
                           value="{{ old('position', isset($filteredData['position']) ? $filteredData['position'] : '') }}">
                    @include('partials.errors', [
                        'err' => $err['position'] ?? null
                    ])
                </div>

                <div class="form-group">
                    <label for="age">Employee age</label><br>
                    <input type="number" class="form-control" name="age" step="1" min="15" max="100"
                           value="{{ old('age', isset($filteredData['age']) ? $filteredData['age'] : '') }}">
                    @include('partials.errors', [
                        'err' => $err['age'] ?? null
                    ])
                </div>

                <div class="form-group">
                    <label>Employee sex:</label><br>
                    <input type="radio" name="sex" value="m" {{ $filteredData['sex'] === 'm' ? 'checked' : '' }}>
                    <label for="male">Male</label><br>
                    <input type="radio" name="sex" value="f" {{ $filteredData['sex'] === 'f' ? 'checked' : '' }}>
                    <label for="female">Female</label>
                    @include('partials.errors', [
                        'err' => $err['sex'] ?? null
                    ])
                </div>

                <div class="form-group">
                    <label for="email">Employee email</label>
                    <input type="email" class="form-control"
                           name="email"
                           value="{{ old('email', isset($filteredData['email']) ? $filteredData['email'] : '') }}">
                    @include('partials.errors', [
                        'err' => $err['email'] ?? null
                    ])
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
