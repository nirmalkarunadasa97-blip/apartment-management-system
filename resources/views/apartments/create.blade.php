@extends('layer.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Apartment</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    {{-- Show global validation errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('apartments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="contact_no">Contact No</label>
                            <input type="text" class="form-control @error('contact_no') is-invalid @enderror"
                                   id="contact_no" name="contact_no" value="{{ old('contact_no') }}">
                            @error('contact_no')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_of_bedroom">Number of Bedrooms</label>
                            <input type="number" class="form-control @error('no_of_bedroom') is-invalid @enderror"
                                   id="no_of_bedroom" name="no_of_bedroom" min="0" value="{{ old('no_of_bedroom') }}">
                            @error('no_of_bedroom')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_of_bathroom">Number of Bathrooms</label>
                            <input type="number" class="form-control @error('no_of_bathroom') is-invalid @enderror"
                                   id="no_of_bathroom" name="no_of_bathroom" min="0" value="{{ old('no_of_bathroom') }}">
                            @error('no_of_bathroom')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="apartment_no">Apartment No</label>
                            <input type="text" class="form-control @error('apartment_no') is-invalid @enderror"
                                   id="apartment_no" name="apartment_no" value="{{ old('apartment_no') }}" required>
                            @error('apartment_no')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="monthly_rent">Monthly Rent</label>
                            <input type="number" step="0.01" class="form-control @error('monthly_rent') is-invalid @enderror"
                                   id="monthly_rent" name="monthly_rent" min="0" value="{{ old('monthly_rent') }}">
                            @error('monthly_rent')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="images">Images</label>
                            <input type="file" class="form-control @error('images.*') is-invalid @enderror"
                                   id="images" name="images[]" accept="image/*" multiple required>
                            <small class="form-text text-muted">You can select multiple images.</small>
                            @error('images.*')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Apartment</button>
                        <a href="{{ route('apartments.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
