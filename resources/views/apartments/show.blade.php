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
                        <a href="{{ route('apartments.edit', $apartment->apartment_id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('apartments.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        @if ($apartment->images->count() > 0)
                            <div class="row">
                                @foreach ($apartment->images as $image)
                                    <div class="col-md-4 mb-3">
                                        <img src="{{ asset('storage/' . $image->image_path) }}"
                                            alt="{{ $image->image_name }}"
                                            style="max-width: 100%; height: 200px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <img src="https://via.placeholder.com/400x300?text=No+Images" alt="No Images"
                                style="max-width: 100%; height: auto; margin-bottom: 20px;">
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
