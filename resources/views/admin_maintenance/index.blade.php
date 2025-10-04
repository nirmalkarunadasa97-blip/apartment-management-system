@extends('layer.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Maintenance Request</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Apartment</th>
                                            <th>Maintenance Type</th>
                                            @if (auth()->user()->user_role_id == 1)
                                                <th>Maintenance Staff</th>
                                            @endif
                                            <th>Status</th>
                                            @if (auth()->user()->user_role_id == 1)
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listdata as $data)
                                            <tr>
                                                <td>{{ $data->user->name }}</td>
                                                <td>{{ $data->apartment_id }}</td>
                                                <td>{{ $data->maintenanceType->type }}</td>
                                                @if (auth()->user()->user_role_id == 1)
                                                    <td>{{ optional($data->staff)->name ?? '-' }}</td>
                                                @endif
                                                @if (auth()->user()->user_role_id == 1)
                                                    @if ($data->status == 1)
                                                        <td><span class="badge badge-warning">Pending</span></td>
                                                    @elseif($data->status == 2)
                                                        <td><span class="badge badge-primary">Assign</span></td>
                                                    @elseif($data->status == 3)
                                                        <td><span class="badge badge-success">Done</span></td>
                                                    @endif
                                                @endif

                                                @if (auth()->user()->user_role_id == 2)
                                                    <td>

                                                        @if ($data->status == 2)
                                                            <form
                                                                action="{{ route('maintenances.done', ['id' => $data->maintenance_id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button class="btn btn-danger btn-sm" type="submit">Done
                                                                </button>
                                                            </form>
                                                        @elseif($data->status == 3)
                                                            <span class="badge badge-success">Done</span>
                                                        @endif

                                                    </td>
                                                @endif

                                                @if (auth()->user()->user_role_id == 1)
                                                    <td>
                                                        @if ($data->status == 1)
                                                            <a href="{{ route('admin_maintenance.edit', $data->maintenance_id) }}"
                                                                title="Edit">
                                                                <i class="fas fa-edit edit-icon"></i>
                                                            </a>
                                                        @else
                                                            <i class="fas fa-edit edit-icon text-muted"
                                                                title="Cannot edit"></i>
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script>
        $(function() {

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
