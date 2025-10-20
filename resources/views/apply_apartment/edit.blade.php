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

                        <div class="row justify-content-end mb-3">
                            <form
                                action="{{ route('apply_apartment.destroy', ['apply_apartment' => $leaseFlat->apartment_application_id]) }}"
                                method="post" id="deleteUserForm">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="deleteUserBtn" class="align btn btn-danger">Delete Apartment
                                    Application
                                </button>
                            </form>
                        </div>

                        <div class="card card-success">

                            <form action="{{ route('apply_apartment.update', $leaseFlat->apartment_application_id) }}"
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
                                                    value="{{ old('lease_date', $leaseFlat->lease_date ?? '') }}">
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
                                                    value="{{ old('lease_end_date', $leaseFlat->lease_end_date ?? '') }}">
                                                @error('lease_end_date')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="income_proof">Income Proof</label>
                                                <input type="file" name="income_proof" class="form-control"
                                                    id="income_proof">
                                                @if (!empty($leaseFlat->income_proof))
                                                    <small class="d-block mt-1">Current File: <a
                                                            href="{{ asset('storage/' . $leaseFlat->income_proof) }}"
                                                            target="_blank">View</a></small>
                                                @endif

                                                @error('income_proof')
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
