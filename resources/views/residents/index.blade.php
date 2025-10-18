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
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

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
                                                    <form action="{{ route('residents.destroy', $resident->resident_id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this resident?')">
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
@endsection
