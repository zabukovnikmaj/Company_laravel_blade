@extends('layout')

@section('content')
    <h1>Employees information</h1>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
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
                            <td>{{ $employee?->branch_office->name }}</td>
                            <td>{{ $employee?->name }}</td>
                            <td>{{ $employee?->position }}</td>
                            <td>{{ $employee?->age }}</td>
                            <td>{{ $employee?->sex }}</td>
                            <td>{{ $employee?->email }}</td>
                            <td>
{{--                                <form action="{{ url('/employees/delete', $employee?->id) }}" method="POST">--}}
                                <form action="{{ route('employee.delete', [$employee?->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('employee.delete', [$employee?->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</button>
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
@endsection
