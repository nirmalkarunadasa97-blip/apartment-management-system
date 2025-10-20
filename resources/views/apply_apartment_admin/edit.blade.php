@extends('layer.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Apartment Application</h1>
                    </div>

                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-success">

                            <form
                                action="{{ route('apply_apartment_admin.update', $leaseApartment->apartment_application_id) }}"
                                method="post" id="newuserform" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" name="apartment_id" value="{{ $apartment_id }}">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lease_date">Lease Date</label>
                                                <input type="date" name="lease_date" class="form-control" id="lease_date"
                                                    value="{{ old('lease_date', $leaseApartment->lease_date ?? '') }}"
                                                    disabled>
                                                @error('lease_date')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lease_end_date">Lease End Date</label>
                                                <input type="date" name="lease_end_date" class="form-control"
                                                    id="lease_end_date"
                                                    value="{{ old('lease_end_date', $leaseApartment->lease_end_date ?? '') }}"
                                                    disabled>
                                                @error('lease_end_date')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="income_proof">Income Proof</label>

                                                @if (!empty($leaseApartment->income_proof))
                                                    <small class="d-block mt-1">Current File: <a
                                                            href="{{ asset('storage/' . $leaseApartment->income_proof) }}"
                                                            target="_blank">View</a></small>
                                                @endif

                                                @error('income_proof')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" class="form-control" id="status">
                                                    <option value="1"
                                                        {{ old('status', $leaseApartment->status) == 1 ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="2"
                                                        {{ old('status', $leaseApartment->status) == 2 ? 'selected' : '' }}>
                                                        Accept
                                                    </option>
                                                    <option value="3"
                                                        {{ old('status', $leaseApartment->status) == 3 ? 'selected' : '' }}>
                                                        Reject
                                                    </option>
                                                    <option value="4"
                                                        {{ old('status', $leaseApartment->status) == 3 ? 'selected' : '' }}>
                                                        Expire
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <small class="text-danger">{{ $message }}</small>
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
