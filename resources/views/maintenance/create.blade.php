@extends('layer.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>New Maintenance Request</h1>
                    </div>

                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="{{ route('maintenance.store') }}" method="post" id="newuserform">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="apartment_id">Apartment No</label>
                                                <input type="text" name="apartment_id" class="form-control"
                                                    id="apartment_id" value="{{ $ApartmentId }}" readonly>
                                                @error('apartment_id')
                                                    <small class="text-danger"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Maintenance Type</label>
                                                <select name="maintenance_type" id="maintenance_type" class="form-control">

                                                    <option value="">Select</option>
                                                    @foreach ($maintenanceType as $item)
                                                        <option
                                                            {{ old('maintenance_type') == $item->maintenance_type_id ? 'selected' : '' }}
                                                            value="{{ $item->maintenance_type_id }}">{{ $item->type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('maintenance_type')
                                                    <small class="text-danger"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" class="form-control" id="description" rows="4">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <small class="text-danger"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-dark w-100">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
