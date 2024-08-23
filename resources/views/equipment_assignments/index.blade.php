@extends('adminlte::page')

@section('title', 'Listado de Asignaciones de Equipos')

@section('content_header')
    <h1>Listado de Asignaciones de Equipos</h1>
@stop

@section('content')

<div class="row mb-2">
    <div class="col-md-12">
        <form action="{{ route('equipment_assignments.index') }}" method="GET" class="form-inline d-flex justify-content-between">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Buscar por código de equipo" value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-success">Buscar</button>
                </div>
            </div>
            <a href="{{ route('equipment_assignments.create') }}" class="btn btn-primary ml-2">Nuevo Registro</a>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Asignaciones de Equipos</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Código de Equipo</th>
                            <th>Fecha de Asignación</th>
                            <th>Fecha de Devolución</th>
                            <th>Estado</th>
                            <th>Departamento</th>
                            <th>Persona</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignments as $assignment)
                        <tr>
                            <td>{{ $assignment->id }}</td>
                            <td>{{ $assignment->asset->codigo }}</td>
                            <td>{{ $assignment->fecha_asignacion }}</td>
                            <td>{{ $assignment->fecha_devolucion }}</td>
                            <td>{{ $assignment->estado }}</td>
                            <td>{{ $assignment->department->nombre }}</td>
                            <td>{{ $assignment->people->nombres }}</td>
                            <td>
                                <a href="{{ route('equipment_assignments.edit', $assignment->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('equipment_assignments.destroy', $assignment->id) }}" method="POST" class="d-inline-block delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $assignments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmación de Eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que quieres eliminar este registro? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let deleteForm = document.getElementById('deleteForm');

    document.querySelectorAll('form.delete-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Previene el envío inmediato del formulario

            // Configura el formulario de eliminación
            deleteForm.action = form.action; // Establece la acción del formulario de eliminación

            // Muestra el modal
            $('#confirmationModal').modal('show');
        });
    });
});
</script>
@stop
