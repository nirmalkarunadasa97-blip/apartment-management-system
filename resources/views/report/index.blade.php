@extends('layer.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Reports</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-success">

                            <div class="card-body">
                                <canvas id="userRegistrationBarChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-warning">

                            <div class="card-body">
                                <canvas id="maintenancePieChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-primary">

                            <div class="card-body">
                                <canvas id="apartmentApplicationLineChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('userRegistrationBarChart').getContext('2d');
            var userRegistrationBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! $annualUserRegistrationData->keys()->toJson() !!},
                    datasets: [{
                        label: 'Tenant Registrations',
                        data: {!! $annualUserRegistrationData->values()->toJson() !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },


                options: {
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: 'Annual Resident Registration (Last 5 Years)'
                        }
                    }
                }
            });


            var maintenanceCtx = document.getElementById('maintenancePieChart').getContext('2d');
            new Chart(maintenanceCtx, {
                type: 'pie',
                data: {
                    labels: {!! $annualMaintenanceRequestData->keys()->toJson() !!},
                    datasets: [{
                        label: 'Maintenance Requests',
                        data: {!! $annualMaintenanceRequestData->values()->toJson() !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)'
                        ],
                        borderColor: '#fff',
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: 'Annual Maintenance Requests (Last 5 Years)'
                        }
                    }
                }
            });


            // Line chart for Apartment Lease Applications
            var apartmentCtx = document.getElementById('apartmentApplicationLineChart').getContext('2d');

            new Chart(apartmentCtx, {
                type: 'line',
                data: {
                    labels: {!! $annualApartmentApplicationData->keys()->toJson() !!},
                    datasets: [{
                        label: 'Apartment Applications',
                        data: {!! $annualApartmentApplicationData->values()->toJson() !!},
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true,
                        borderWidth: 2,
                        tension: 0.3, // smooth curve
                        pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Applications'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Year'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: 'Apartment Lease Applications (Last 5 Years)'
                        }
                    }
                }
            });

        });
    </script>
@endsection
