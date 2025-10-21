@extends('layer.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Admin & Staff Details</h1>
                    </div>

                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row justify-content-end mb-3">
                            <form action="{{ route('admin_staff.destroy', ['admin_staff' => $data->id]) }}" method="post"
                                id="deleteUserForm">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="deleteUserBtn" class="align btn btn-danger">Delete Account
                                </button>
                            </form>
                        </div>
                        <div class="card card-success">

                            <form action="{{ route('admin_staff.update', ['admin_staff' => $data->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    value="{{ $data->email }}" disabled>
                                                @error('email')
                                                    <small class="text-danger"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    value="{{ $data->name }}" disabled>
                                                @error('name')
                                                    <small class="text-danger"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="user_role">User Role</label>
                                                <input type="text" name="user_role" class="form-control" id="user_role"
                                                    value="{{ $data->userRole->user_role }}" disabled>
                                                @error('contact_number')
                                                    <small class="text-danger"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select name="status" id="status" class="form-control">

                                                    <option value="1" {{ $data->is_active == 1 ? 'selected' : '' }}>
                                                        Active
                                                    </option>
                                                    <option value="0" {{ $data->is_active == 0 ? 'selected' : '' }}>
                                                        Deactive</option>
                                                </select>
                                                @error('status')
                                                    <small class="text-danger"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer row justify-content-end mb-3 margin">
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
