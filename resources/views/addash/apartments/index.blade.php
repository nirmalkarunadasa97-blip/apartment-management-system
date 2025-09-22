@extends('layer.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Apartments</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('apartments.create') }}" class="btn btn-primary">Add Apartment</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip Code</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($apartments as $apartment)
                    <tr>
                        <td>{{ $apartment->name }}</td>
                        <td>{{ $apartment->address }}</td>
                        <td>{{ $apartment->city }}</td>
                        <td>{{ $apartment->state }}</td>
                        <td>{{ $apartment->zip_code }}</td>
                        <td>{{ $apartment->description }}</td>
                        <td>
                            <a href="{{ route('apartments.edit', $apartment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('apartments.destroy', $apartment->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this apartment?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($apartments->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">No apartments found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
