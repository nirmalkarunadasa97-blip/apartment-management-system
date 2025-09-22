@extends('layer.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Apartment Details</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('apartments.edit', $apartment->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('apartments.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5>Name: {{ $apartment->name }}</h5>
                    <p><strong>Address:</strong> {{ $apartment->address }}</p>
                    <p><strong>City:</strong> {{ $apartment->city }}</p>
                    <p><strong>State:</strong> {{ $apartment->state }}</p>
                    <p><strong>Zip Code:</strong> {{ $apartment->zip_code }}</p>
                    <p><strong>Description:</strong> {{ $apartment->description ?: 'N/A' }}</p>
                    <p><strong>Created At:</strong> {{ $apartment->created_at->format('Y-m-d H:i:s') }}</p>
                    <p><strong>Updated At:</strong> {{ $apartment->updated_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
