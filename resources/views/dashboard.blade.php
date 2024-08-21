@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <!-- Displaying counts -->
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fa fa-table"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Bien Patrmonial</span>
                    <span class="info-box-number">{{ $assetCount }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fa fa-building"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Departamentos</span>
                    <span class="info-box-number">{{ $departmentCount }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fa fa-cogs"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Equipo Asignado</span>
                    <span class="info-box-number">{{ $equipmentAssignmentCount }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-map-marker"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Localizacion</span>
                    <span class="info-box-number">{{ $locationCount }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fa fa-wrench"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Mantenimientos</span>
                    <span class="info-box-number">{{ $maintenanceCount }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Personas</span>
                    <span class="info-box-number">{{ $peopleCount }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-teal"><i class="fa fa-briefcase"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Cargos</span>
                    <span class="info-box-number">{{ $positionCount }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-gray"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Usuarios</span>
                    <span class="info-box-number">{{ $userCount }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Example -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Records Count Chart</h3>
                </div>
                <div class="card-body">
                    <canvas id="myChart" style="height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Assets', 'Departments', 'Equipment Assignments', 'Locations', 'Maintenances', 'People', 'Positions', 'Users'],
                    datasets: [{
                        label: 'Number of Records',
                        data: [
                            @json($assetCount),
                            @json($departmentCount),
                            @json($equipmentAssignmentCount),
                            @json($locationCount),
                            @json($maintenanceCount),
                            @json($peopleCount),
                            @json($positionCount),
                            @json($userCount),
                        ],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@stop
