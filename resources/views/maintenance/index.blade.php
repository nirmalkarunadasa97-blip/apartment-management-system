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

                <div class="text-right">
                    <a href="{{ route('maintenance.create') }}" class="btn btn-success">
                        New Maintenance Request
                    </a>
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
                                            <th>Apartment</th>
                                            <th>Maintenance Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listdata as $data)
                                            <tr>
                                                <td>{{ $data->apartment->apartment_no ?? 'N/A' }}</td>
                                                <td>{{ $data->maintenanceType->type }}</td>
                                                @if ($data->status == 1)
                                                    <td><span class="badge badge-warning">Pending</span></td>
                                                @elseif($data->status == 2)
                                                    <td><span class="badge badge-primary">Assign</span></td>
                                                @elseif($data->status == 3)
                                                    <td><span class="badge badge-success">Done</span></td>
                                                @endif


                                                @if ($data->status == 1)
                                                    <td> <a href="{{ route('maintenance.edit', $data->maintenance_id) }}"
                                                            title="Edit">
                                                            <i class="fas fa-edit edit-icon"></i>
                                                        </a>
                                                    </td>
                                                @elseif($data->status == 2)
                                                    <td> <i class="fas fa-edit edit-icon text-muted"
                                                            title="Cannot edit"></i>
                                                    </td>
                                                @elseif($data->status == 3)
                                                    <td><span class="badge badge-success">Done</span></td>
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
