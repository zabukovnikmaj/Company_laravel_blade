<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List employees</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
@extends('partials.navBar');

<div class="container">
    <h1>Employees information</h1>
    <div class="row">
        <div class="col-md-12">
            <p>
                <a href="{{ url('/employees/create') }}" class="btn btn-primary">New employee</a>
                <a href="{{ url('/') }}" class="btn btn-default">Back</a>
            </p>
            <table class="table">
                <thead>
                <tr>
                    <th>Branch office</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Age</th>
                    <th>Sex</th>
                    <th>Email</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (count($employees) > 0)
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee['branchOffice'] == null ? 'This branch office does not exist!' : $employee['branchOffice'] }}</td>
                            <td>{{ $employee['name'] }}</td>
                            <td>{{ $employee['position'] }}</td>
                            <td>{{ $employee['age'] }}</td>
                            <td>{{ $employee['sex'] }}</td>
                            <td>{{ $employee['email'] }}</td>
                            <td>
                                <form action="{{ url('/employees/delete', $employee['uuid']) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ url('/employees/edit', $employee['uuid']) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">No employees found!</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
