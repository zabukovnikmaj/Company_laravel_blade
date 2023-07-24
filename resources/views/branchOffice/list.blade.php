@extends('layout')

@section('content')
    <h1>Branch offices information</h1>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <p>
                <a href="{{ url('/branchOffice/create') }}" class="btn btn-primary">New branch office</a>
                <a href="{{ url('/') }}" class="btn btn-default">Back</a>
            </p>
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Products</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (count($branchOffices) > 0)
                    @foreach ($branchOffices as $branchOffice)
                        <tr>
                            <td>{{ $branchOffice->name }}</td>
                            <td>{{ $branchOffice->address }}</td>
                            <td>{{ $branchOffice->products->pluck('name')->implode(', ') }}</td>
                            <td>
                                <form action="{{ url('/branchOffice/delete', $branchOffice->id) }}"
                                      method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ url('/branchOffice/edit', $branchOffice->id) }}"
                                       class="btn btn-primary btn-sm">Edit</a>
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Confirm?');">Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No branch offices found!</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
