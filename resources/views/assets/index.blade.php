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
                        <!-- Formulario de Búsqueda -->
                        <form method="GET" action="{{ route('assets.index') }}" class="form-inline mr-2">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar..." value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                </div>
                            </div>
                        </form>
                        <!-- Botón Nuevo Registro -->
                        <a href="{{ route('assets.create') }}" class="btn btn-primary">Nuevo Registro</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <!-- Nueva Columna con Botón de Vista -->
                            <th>Vista</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Número de Serie</th>
                            <th>Estado Actual</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $asset)
                        <tr>
                            <!-- Columna con Botón de Vista -->
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal"
                                    data-id="{{ $asset->id }}"
                                    data-codigo="{{ $asset->codigo }}"
                                    data-nombre="{{ $asset->nombre }}"
                                    data-marca="{{ $asset->marca }}"
                                    data-modelo="{{ $asset->modelo }}"
                                    data-numero_serie="{{ $asset->numero_serie }}"
                                    data-estado_actual="{{ $asset->estado_actual }}"
                                    data-imagen="{{ asset('storage/'.$asset->imagen) }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                            <td>{{ $asset->codigo }}</td>
                            <td>{{ $asset->nombre }}</td>
                            <td>{{ $asset->marca }}</td>
                            <td>{{ $asset->modelo }}</td>
                            <td>{{ $asset->numero_serie }}</td>
                            <td>{{ $asset->estado_actual }}</td>
                            <td>
                                <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este activo?');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">No hay activos disponibles.</td>
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

<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Detalles del Activo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="modalCodigo">Código</label>
                    <input type="text" class="form-control" id="modalCodigo" readonly>
                </div>
                <div class="form-group">
                    <label for="modalNombre">Nombre</label>
                    <input type="text" class="form-control" id="modalNombre" readonly>
                </div>
                <div class="form-group">
                    <label for="modalMarca">Marca</label>
                    <input type="text" class="form-control" id="modalMarca" readonly>
                </div>
                <div class="form-group">
                    <label for="modalModelo">Modelo</label>
                    <input type="text" class="form-control" id="modalModelo" readonly>
                </div>
                <div class="form-group">
                    <label for="modalNumeroSerie">Número de Serie</label>
                    <input type="text" class="form-control" id="modalNumeroSerie" readonly>
                </div>
                <div class="form-group">
                    <label for="modalEstadoActual">Estado Actual</label>
                    <input type="text" class="form-control" id="modalEstadoActual" readonly>
                </div>
                <div class="form-group">
                    <label for="modalImagen">Imagen</label>
                    <img id="modalImagen" src="" class="img-fluid" alt="Imagen del Activo">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Script para llenar el modal con los datos del activo
    $('#viewModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que disparó el modal
        var id = button.data('id');
        var codigo = button.data('codigo');
        var nombre = button.data('nombre');
        var marca = button.data('marca');
        var modelo = button.data('modelo');
        var numero_serie = button.data('numero_serie');
        var estado_actual = button.data('estado_actual');
        var imagen = button.data('imagen');

        var modal = $(this);
        modal.find('#modalCodigo').val(codigo);
        modal.find('#modalNombre').val(nombre);
        modal.find('#modalMarca').val(marca);
        modal.find('#modalModelo').val(modelo);
        modal.find('#modalNumeroSerie').val(numero_serie);
        modal.find('#modalEstadoActual').val(estado_actual);
        modal.find('#modalImagen').attr('src', imagen);
    });
</script>

@stop
