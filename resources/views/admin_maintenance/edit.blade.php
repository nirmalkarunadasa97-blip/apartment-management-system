@extends('layer.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Maintenance Request</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form
                                action="{{ route('admin_maintenance.update', ['admin_maintenance' => $maintenanceRequest->maintenance_id]) }}"
                                method="post">
                                @csrf
                                @method('PATCH')

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="apartment_id">Apartment No</label>
                                                <input type="text" name="apartment_id" class="form-control"
                                                    id="apartment_id"
                                                    value="{{ old('apartment_id', $maintenanceRequest->apartment_id) }}"
                                                    disabled>
                                                @error('apartment_id')
                                                    <small class="text-danger"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Maintenance Type</label>
                                                <select name="maintenance_type" id="maintenance_type" class="form-control"
                                                    disabled>
                                                    @foreach ($maintenanceType as $item)
                                                        <option value="{{ $item->maintenance_type_id }}"
                                                            {{ old('maintenance_type', $maintenanceRequest->maintenance_type_id) == $item->maintenance_type_id ? 'selected' : '' }}>
                                                            {{ $item->type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('maintenance_type')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" class="form-control" id="description" rows="4" placeholder="Describe the issue"
                                                    disabled>{{ old('description', $maintenanceRequest->description) }}</textarea>
                                                @error('description')
                                                    <small class="text-danger"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Maintenance Staff</label>
                                            <select name="staff" id="staff" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($staff as $item)
                                                    <option {{ old('staff') == $item->id ? 'selected' : '' }}
                                                        value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('staff')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-dark w-100">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
