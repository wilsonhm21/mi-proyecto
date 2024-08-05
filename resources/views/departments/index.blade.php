@extends('adminlte::page')

@section('title', 'Departamentos')

@section('content_header')
<h1>Departamentos</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        @include('shared.error-message')
        @include('shared.success-message') <!-- Incluye un mensaje de éxito si está presente -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Departamentos</h3>
                <div class="card-tools">
                    <a href="{{ route('departments.create') }}" class="btn btn-primary">Nuevo Departamento</a>
                </div>
            </div>
            <!-- /.card-header -->
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
                        @forelse($departments as $department)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $department->nombre }}</td>
                                <td>{{ $department->descripcion }}</td>
                                <td>{{ $department->location ? $department->location->direccion : 'No asignado' }}</td>
                                <td>
                                    <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este departamento?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay departamentos disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

@stop
