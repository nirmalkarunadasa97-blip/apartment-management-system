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
                    <form action="{{ route('apartments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="contact_no">Contact No</label>
                            <input type="text" class="form-control" id="contact_no" name="contact_no">
                        </div>
                        <div class="form-group">
                            <label for="no_of_bedroom">Number of Bedrooms</label>
                            <input type="number" class="form-control" id="no_of_bedroom" name="no_of_bedroom" min="0">
                        </div>
                        <div class="form-group">
                            <label for="no_of_bathroom">Number of Bathrooms</label>
                            <input type="number" class="form-control" id="no_of_bathroom" name="no_of_bathroom" min="0">
                        </div>
                        <div class="form-group">
                            <label for="apartment_no">Apartment No</label>
                            <input type="text" class="form-control" id="apartment_no" name="apartment_no" required>
                        </div>
                        <div class="form-group">
                            <label for="monthly_rent">Monthly Rent</label>
                            <input type="number" step="0.01" class="form-control" id="monthly_rent" name="monthly_rent" min="0">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" id="status" name="status">
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
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
