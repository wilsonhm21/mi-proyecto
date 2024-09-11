@extends('adminlte::page')

@section('title', 'Posiciones')

@section('content_header')
    <h1>Posiciones</h1>
@stop

@section('content')

<div class="row mb-3">
    <div class="col-md-12">
        @include('shared.success-message')
        @include('shared.error-message')
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Título -->
            <h3 class="card-title mb-0">Lista de Cargos por Departamento</h3>

            <!-- Contenedor de Búsqueda y Botón -->
            <div class="d-flex">
                <!-- Formulario de Búsqueda -->
                <form method="GET" action="{{ route('positions.index') }}" class="d-inline-block mr-2">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar por nombre" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                    </div>
                </form>

                <!-- Botón Nuevo Cargo -->
                <a href="{{ route('positions.create') }}" class="btn btn-primary">
                    Nuevo Cargo
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @forelse($positionsGroupedByDepartment as $departmentId => $positions)
            @php
                $department = $departments->find($departmentId);
            @endphp

            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ $department ? $department->nombre : 'Departamento no encontrado' }}
                    </h4>
                </div>
                <div class="card-body">
                    @if($positions->isNotEmpty())
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha de Fin</th>
                                    <th class="actions">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($positions as $position)
                                    <tr>
                                        <td>{{ $position->id }}</td>
                                        <td>{{ $position->nombre }}</td>
                                        <td>{{ $position->fecha_inicio }}</td>
                                        <td>{{ $position->fecha_fin }}</td>
                                        <td class="actions">
                                            <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-warning btn-xs">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('positions.destroy', $position->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar esta posición?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-xs">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No hay posiciones para este departamento.</p>
                    @endif
                </div>
            </div>
        @empty
            <p>No hay departamentos disponibles.</p>
        @endforelse
    </div>
</div>

@stop

@section('css')
    <style>
        .table th, .table td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .table .actions {
            text-align: center;
            width: 150px;
        }

        .table .actions a,
        .table .actions button {
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            font-size: 14px;
        }

        .btn-xs {
            padding: 2px 6px;
            font-size: 12px;
        }
    </style>
@stop
