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
                    @if($apartment->photo)
                        <img src="{{ asset('storage/' . $apartment->photo) }}" alt="Apartment Photo" style="max-width: 60%; height: auto; margin-bottom: 20px;">
                    @else
                        <img src="https://via.placeholder.com/400x300?text=No+Photo" alt="No Photo" style="max-width: 100%; height: auto; margin-bottom: 20px;">
                    @endif

                    <h5>Apartment No: {{ $apartment->apartment_no }}</h5>
                    <p><strong>Contact No:</strong> {{ $apartment->contact_no ?: 'N/A' }}</p>
                    <p><strong>Number of Bedrooms:</strong> {{ $apartment->no_of_bedroom ?: 'N/A' }}</p>
                    <p><strong>Number of Bathrooms:</strong> {{ $apartment->no_of_bathroom ?: 'N/A' }}</p>
                    <p><strong>Monthly Rent:</strong> ₹{{ number_format($apartment->monthly_rent ?? 0, 2) }}</p>
                    <p><strong>Description:</strong> {{ $apartment->description ?: 'N/A' }}</p>
                    <p><strong>Status:</strong> {{ $apartment->status ?: 'N/A' }}</p>
                    <p><strong>Created At:</strong> {{ $apartment->created_at->format('Y-m-d H:i:s') }}</p>
                    <p><strong>Updated At:</strong> {{ $apartment->updated_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>


        </div>
    </section>
</div>
@endsection
