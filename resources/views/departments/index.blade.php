@extends('adminlte::page')

@section('title', 'Departamentos')

@section('content_header')
    <h1>Departamentos</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Título -->
                    <h3 class="card-title mb-0">Lista de Departamentos</h3>

                    <!-- Contenedor de Búsqueda y Botón -->
                    <div class="d-flex">
                        <!-- Formulario de Búsqueda -->
                        <form method="GET" action="{{ route('departments.index') }}" class="d-inline-block mr-2">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                </div>
                            </div>
                        </form>

                        <!-- Botón Nuevo Departamento -->
                        <a href="{{ route('departments.create') }}" class="btn btn-primary">
                            Nuevo Departamento
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <!-- Tabla Principal (Opcional) -->
                <table class="table table-bordered mb-4">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Piso</th>
                            <th>Descripción</th>
                            <th>Ubicación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $department)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $department->nombre }}</td>
                            <td>{{ $department->piso }}</td>
                            <td>{{ $department->descripcion }}</td>
                            <td>{{ $department->location ? $department->location->direccion : 'No asignado' }}</td>
                            <td>
                                <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Está seguro de eliminar este departamento?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay departamentos disponibles.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Tablas Agrupadas por Piso y Ubicación -->
                @foreach($departmentsGroupedByFloorAndLocation as $key => $departmentsGroup)
                    @php
                        // Dividir la clave para obtener ubicación y piso
                        list($locationId, $floor) = explode('-', $key);
                        $location = $locations->find($locationId);
                    @endphp

                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="card-title">
                                {{ $location ? $location->direccion : 'Desconocida' }} - Piso {{ $floor }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Ubicación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($departmentsGroup as $department)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $department->nombre }}</td>
                                        <td>{{ $department->descripcion }}</td>
                                        <td>{{ $department->location ? $department->location->direccion : 'No asignado' }}</td>
                                        <td>
                                            <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Está seguro de eliminar este departamento?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No hay departamentos en este piso.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card-footer">
                {{ $departments->links() }} <!-- Paginación -->
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@stop
