@extends('layer.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Resident</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('residents.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Update Resident Information</h3>
                            </div>
                            <form action="{{ route('residents.update', $resident->resident_id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="user_id">Select User <span class="text-danger">*</span></label>
                                                <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                                    <option value="">-- Select User --</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}"
                                                            {{ (old('user_id', $resident->user_id) == $user->id) ? 'selected' : '' }}>
                                                            {{ $user->name }} ({{ $user->email }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('user_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contact_number">Contact Number</label>
                                                <input type="text" name="contact_number" id="contact_number"
                                                    class="form-control @error('contact_number') is-invalid @enderror"
                                                    value="{{ old('contact_number', $resident->contact_number) }}"
                                                    maxlength="15"
                                                    placeholder="Enter contact number">
                                                @error('contact_number')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nic">NIC Number</label>
                                                <input type="text" name="nic" id="nic"
                                                    class="form-control @error('nic') is-invalid @enderror"
                                                    value="{{ old('nic', $resident->nic) }}"
                                                    maxlength="20"
                                                    placeholder="Enter NIC number">
                                                @error('nic')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nic_copy">NIC Copy (Upload)</label>
                                                @if($resident->nic_copy)
                                                    <div class="mb-2">
                                                        <small class="text-muted">Current file: </small>
                                                        <a href="{{ asset('storage/' . $resident->nic_copy) }}" target="_blank" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i> View Current
                                                        </a>
                                                    </div>
                                                @endif
                                                <input type="file" name="nic_copy" id="nic_copy"
                                                    class="form-control @error('nic_copy') is-invalid @enderror"
                                                    accept="image/*,.pdf">
                                                <small class="form-text text-muted">Leave empty to keep current file. Accepted formats: Images or PDF</small>
                                                @error('nic_copy')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" id="address" rows="3"
                                            class="form-control @error('address') is-invalid @enderror"
                                            maxlength="255"
                                            placeholder="Enter full address">{{ old('address', $resident->address) }}</textarea>
                                        <small class="form-text text-muted">Maximum 255 characters</small>
                                        @error('address')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update Resident
                                    </button>
                                    <a href="{{ route('residents.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                    <a href="{{ route('residents.show', $resident->resident_id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
