@extends('layer.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Apartment</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('apartments.update', $apartment->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="contact_no">Contact No</label>
                            <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{ $apartment->contact_no ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="no_of_bedroom">Number of Bedrooms</label>
                            <input type="number" class="form-control" id="no_of_bedroom" name="no_of_bedroom" value="{{ $apartment->no_of_bedroom ?? '' }}" min="0">
                        </div>
                        <div class="form-group">
                            <label for="no_of_bathroom">Number of Bathrooms</label>
                            <input type="number" class="form-control" id="no_of_bathroom" name="no_of_bathroom" value="{{ $apartment->no_of_bathroom ?? '' }}" min="0">
                        </div>
                        <div class="form-group">
                            <label for="apartment_no">Apartment No</label>
                            <input type="text" class="form-control" id="apartment_no" name="apartment_no" value="{{ $apartment->apartment_no }}" required>
                        </div>
                        <div class="form-group">
                            <label for="monthly_rent">Monthly Rent</label>
                            <input type="number" step="0.01" class="form-control" id="monthly_rent" name="monthly_rent" value="{{ $apartment->monthly_rent ?? '' }}" min="0">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ $apartment->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" id="status" name="status" value="{{ $apartment->status ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            @if($apartment->photo)
                                <img src="{{ asset('storage/' . $apartment->photo) }}" alt="Current Photo" style="max-width: 200px; margin-bottom: 10px;">
                                <br>
                            @endif
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                            <small class="form-text text-muted">Leave empty to keep current photo.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Apartment</button>
                        <a href="{{ route('apartments.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
