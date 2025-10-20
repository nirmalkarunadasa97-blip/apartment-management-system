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
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Resident Name</th>
                                            <th>Lease Date</th>
                                            <th>Lease End Date</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listdata as $data)
                                            <tr>
                                                <td>{{ $data->user->name }}</td>
                                                <td>{{ $data->lease_date }}</td>
                                                <td>{{ $data->lease_end_date }}</td>

                                                @if ($data->status == 1)
                                                    <td><span class="badge badge-success">Pending</span></td>
                                                @elseif($data->status == 2)
                                                    <td><span class="badge badge-info">Accepted</span></td>
                                                @elseif($data->status == 3)
                                                    <td><span class="badge badge-danger">Reject</span></td>
                                                @elseif($data->status == 4)
                                                    <td><span class="badge badge-danger">Expire</span></td>
                                                @endif

                                                @if ($data->status == 1 || $data->status == 2)
                                                    <td class="center-icons">
                                                        <a href="{{ route('apply_apartment_admin.edit', $data->apartment_application_id) }}"
                                                            title="edit">
                                                            <i class="fas fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                @elseif($data->status == 3 || $data->status == 4)
                                                    <td class="center-icons">
                                                        <span title="Edit disabled">
                                                            <i class="fas fa-edit text-muted"></i>
                                                        </span>
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
