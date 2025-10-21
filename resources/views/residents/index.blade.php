@extends('layer.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Residents Management</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('residents.create') }}" class="btn btn-primary">Add New Resident</a>
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
                                <h3 class="card-title">All Residents</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>Contact Number</th>
                                            <th>Address</th>
                                            <th>NIC</th>
                                            <th>NIC Copy</th>
                                            <th>Created Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($residents as $resident)
                                            <tr>
                                                <td>{{ $resident->resident_id }}</td>
                                                <td>{{ $resident->user->name ?? 'N/A' }}</td>
                                                <td>{{ $resident->contact_number ?? 'N/A' }}</td>
                                                <td>{{ $resident->address ?? 'N/A' }}</td>
                                                <td>{{ $resident->nic ?? 'N/A' }}</td>
                                                <td>
                                                    @if($resident->nic_copy)
                                                        <a href="{{ asset('storage/' . $resident->nic_copy) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $resident->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <a href="{{ route('residents.show', $resident->resident_id) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('residents.edit', $resident->resident_id) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('residents.destroy', $resident->resident_id) }}" method="POST" style="display:inline-block;" class="delete-resident-form" id="deleteForm{{ $resident->resident_id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm delete-resident-btn" data-id="{{ $resident->resident_id }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No residents found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                {{ $residents->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-resident-btn');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    const residentId = this.getAttribute('data-id');
                    const form = document.getElementById('deleteForm' + residentId);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Once deleted, you will not be able to recover this resident!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
