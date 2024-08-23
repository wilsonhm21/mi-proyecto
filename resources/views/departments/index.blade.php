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
                <!-- Tabla Principal -->
                <table class="table table-bordered mb-4">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Piso</th>
                            <th>Descripción</th>
                            <th>Ubicación</th>
                            <th class="actions">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $department)
                        <tr>
                            <td>{{ $loop->iteration + ($departments->currentPage() - 1) * $departments->perPage() }}</td>
                            <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $department->nombre }}
                            </td>
                            <td>{{ $department->piso }}</td>
                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $department->descripcion }}
                            </td>
                            <td>{{ $department->location ? $department->location->direccion : 'No asignado' }}</td>
                            <td class="actions">
                                <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info btn-xs">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-xs">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Está seguro de eliminar este departamento?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs">
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

                <!-- Paginación debajo de la primera tabla -->
                <div class="card-footer">
                    {{ $departments->links() }} <!-- Paginación -->
                </div>

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
                                        <th class="actions">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($departmentsGroup as $department)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $department->nombre }}
                                        </td>
                                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $department->descripcion }}
                                        </td>
                                        <td>{{ $department->location ? $department->location->direccion : 'No asignado' }}</td>
                                        <td class="actions">
                                            <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info btn-xs">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-xs">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Está seguro de eliminar este departamento?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-xs">
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

        </div>
    </div>
</div>

@stop

@section('css')
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        .table th, .table td {
            white-space: nowrap; /* Evita el salto de línea en el texto */
            overflow: hidden; /* Oculta el texto que se desborda */
            text-overflow: ellipsis; /* Muestra "..." si el texto es demasiado largo */
        }

        .table .actions {
            text-align: center; /* Alinea los botones en el centro de la columna de acciones */
            width: 150px; /* Ajusta el ancho de la columna de acciones */
        }

        .table .actions a,
        .table .actions button {
            display: inline-block;
            width: 30px; /* Ajusta el ancho de los botones */
            height: 30px; /* Ajusta la altura de los botones */
            line-height: 30px; /* Centra el icono verticalmente */
            font-size: 14px; /* Tamaño del icono */
        }

        .btn-xs {
            padding: 2px 6px; /* Ajusta el padding para botones más pequeños */
            font-size: 12px; /* Tamaño del texto en los botones */
        }

        /* Estilos personalizados para la paginación */
        .pagination {
            justify-content: center; /* Centra la paginación horizontalmente */
        }

        .pagination .page-item .page-link {
            padding: 0.5rem 1rem; /* Ajusta el padding de los enlaces de la página */
            font-size: 14px; /* Tamaño del texto de los enlaces */
        }

        .pagination .page-item .page-link i {
            font-size: 16px; /* Tamaño del icono de paginación */
        }

        /* Opcional: Estilo para los iconos de paginación activos */
        .pagination .page-item.active .page-link {
            background-color: #007bff; /* Color de fondo para el ítem activo */
            border-color: #007bff; /* Color del borde para el ítem activo */
            color: #fff; /* Color del texto para el ítem activo */
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d; /* Color del texto para ítems deshabilitados */
            cursor: not-allowed; /* Cursor de no permitido para ítems deshabilitados */
        }
    </style>
@stop
