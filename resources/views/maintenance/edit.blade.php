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

                        <div class="row justify-content-end mb-3">
                            <form
                                action="{{ route('maintenance.destroy', ['maintenance' => $maintenanceRequest->maintenance_id]) }}"
                                method="post" id="deleteUserForm">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="deleteUserBtn" class="align btn btn-danger">Delete Maintenance
                                    Request
                                </button>
                            </form>
                        </div>
                        <div class="card">
                            <form
                                action="{{ route('maintenance.update', ['maintenance' => $maintenanceRequest->maintenance_id]) }}"
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
                                                    readonly>
                                                @error('apartment_id')
                                                    <small class="text-danger"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Maintenance Type</label>
                                                <select name="maintenance_type" id="maintenance_type" class="form-control">
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
                                                <textarea name="description" class="form-control" id="description" rows="4" placeholder="Describe the issue">{{ old('description', $maintenanceRequest->description) }}</textarea>
                                                @error('description')
                                                    <small class="text-danger"> {{ $message }} </small>
                                                @enderror
                                            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('deleteUserBtn').addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'Once deleted, you will not be able to recover!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {

                    document.getElementById('deleteUserForm').submit();
                }
            });
        });
    </script>
@endsection
