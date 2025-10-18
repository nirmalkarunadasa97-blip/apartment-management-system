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
                        @if(auth()->user()->user_role_id == 1)
                        <a href="{{ route('apartments.create') }}" class="btn btn-primary">Add Apartment</a>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="row">
                    @foreach ($apartments as $apartment)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                @if ($apartment->images->count() > 0)
                                    <img src="{{ asset('storage/' . $apartment->images->first()->image_path) }}"
                                        class="card-img-top" alt="Apartment Photo"
                                        style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/400x300?text=No+Images" class="card-img-top"
                                        alt="No Images" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $apartment->apartment_no }}</h5>
                                    <p class="card-text">
                                        <strong>Bedrooms:</strong> {{ $apartment->no_of_bedroom ?: 'N/A' }}<br>
                                        <strong>Bathrooms:</strong> {{ $apartment->no_of_bathroom ?: 'N/A' }}<br>
                                        <strong>Rent:</strong> ₹{{ number_format($apartment->monthly_rent ?? 0, 2) }}
                                    </p>
                                    <a href="#" class="btn btn-primary">Apply</a>
                                    <a href="{{ route('apartments.show', $apartment->apartment_id) }}"
                                        class="btn btn-secondary">More
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if ($apartments->isEmpty())
                        <div class="col-12">
                            <p class="text-center">No apartments found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection
