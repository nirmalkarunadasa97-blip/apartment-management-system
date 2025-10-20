@extends('layer.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Resident Details</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('residents.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                        <a href="{{ route('residents.edit', $resident->resident_id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('residents.destroy', $resident->resident_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this resident?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Resident Information</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%">Resident ID</th>
                                            <td>{{ $resident->resident_id }}</td>
                                        </tr>
                                        <tr>
                                            <th>User Name</th>
                                            <td>{{ $resident->user->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $resident->user->email ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contact Number</th>
                                            <td>{{ $resident->contact_number ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>NIC Number</th>
                                            <td>{{ $resident->nic ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td>{{ $resident->address ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created Date</th>
                                            <td>{{ $resident->created_at->format('F d, Y h:i A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Updated</th>
                                            <td>{{ $resident->updated_at->format('F d, Y h:i A') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">NIC Copy</h3>
                            </div>
                            <div class="card-body text-center">
                                @if($resident->nic_copy)
                                    @php
                                        $extension = pathinfo($resident->nic_copy, PATHINFO_EXTENSION);
                                    @endphp

                                    @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ asset('storage/' . $resident->nic_copy) }}"
                                             alt="NIC Copy"
                                             class="img-fluid mb-3"
                                             style="max-height: 300px;">
                                    @elseif($extension == 'pdf')
                                        <div class="mb-3">
                                            <i class="fas fa-file-pdf fa-5x text-danger"></i>
                                            <p class="mt-2">PDF Document</p>
                                        </div>
                                    @endif

                                    <a href="{{ asset('storage/' . $resident->nic_copy) }}"
                                       target="_blank"
                                       class="btn btn-primary btn-block">
                                        <i class="fas fa-download"></i> View/Download NIC Copy
                                    </a>
                                @else
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i> No NIC copy uploaded
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Quick Actions</h3>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('residents.edit', $resident->resident_id) }}" class="btn btn-warning btn-block">
                                    <i class="fas fa-edit"></i> Edit Resident
                                </a>
                                <a href="{{ route('residents.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-list"></i> View All Residents
                                </a>
                                <form action="{{ route('residents.destroy', $resident->resident_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete this resident?')">
                                        <i class="fas fa-trash"></i> Delete Resident
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
