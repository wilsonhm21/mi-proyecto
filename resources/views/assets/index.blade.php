@extends('adminlte::page')

@section('title', 'Listado de Activos')

@section('content_header')
    <h1>Listado de Activos</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <!-- Título -->
                    <h3 class="card-title">Listado de Activos</h3>

                    <!-- Contenedor de Botones -->
                    <div class="btn-group">
                        <!-- Botón Nuevo Registro -->
                        <a href="{{ route('assets.create') }}" class="btn btn-primary">Nuevo Registro</a>
                        <!-- Formulario de Búsqueda -->
                        <form method="GET" action="{{ route('assets.index') }}" class="form-inline ml-2">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar..." value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Numero de Serie</th>
                            <th>Estado Actual</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $asset)
                        <tr>
                            <td>{{ $asset->codigo }}</td>
                            <td>{{ $asset->nombre }}</td>
                            <td>{{ $asset->marca }}</td>
                            <td>{{ $asset->modelo }}</td>
                            <td>{{ $asset->numero_serie }}</td>
                            <td>{{ $asset->estado_actual }}</td>
                            <td>
                                <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">No hay activos disponibles.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $assets->links() }}
            </div>
        </div>
    </div>
</div>

@stop
