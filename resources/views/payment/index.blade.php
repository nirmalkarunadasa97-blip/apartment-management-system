@extends('layer.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Payment Details</h1>
                    </div>
                </div>
                @if (auth()->user()->user_role_id == 3)
                    <div class="text-right">
                        <a href="{{ route('payment.form') }}" class="btn btn-success">
                            Pay Now
                        </a>
                    </div>
                @endif
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
                                            <th>Date</th>
                                            @if (auth()->user()->user_role_id == 1)
                                                <th>Apartment No</th>
                                                <th>Name</th>
                                            @endif
                                            <th>Payment Type</th>
                                            <th>Amount</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listdata as $data)
                                            <tr>

                                                <td>{{ $data->created_at->format('Y-m-d') }}</td>
                                                @if (auth()->user()->user_role_id == 1)
                                                    <td>{{ $data->apartment->apartment_id }}</td>
                                                    <td>{{ $data->resident->name }}</td>
                                                @endif
                                                <td>{{ $data->paymentType->type }}</td>
                                                <td>{{ $data->amount }}</td>
                                                @if ($data->status == 'succeeded')
                                                    <td><span class="badge badge-success">Success</span></td>
                                                @elseif($data->status == 'failed')
                                                    <td><span class="badge badge-danger">Failed</span></td>
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
