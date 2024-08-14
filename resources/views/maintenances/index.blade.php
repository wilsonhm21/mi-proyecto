@extends('adminlte::page')

@section('title', 'Listado de Mantenimientos')

@section('content_header')
    <h1>Listado de Mantenimientos</h1>
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
            <h3 class="card-title mb-0">Mantenimientos</h3>
            <div class="d-flex">
                <form method="GET" action="{{ route('maintenances.index') }}" class="d-inline-block mr-2">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar por bien patrimonial" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('maintenances.create') }}" class="btn btn-primary">Nuevo Registro</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Bien Patrimonial</th>
                    <th>Descripción</th>
                    <th>Fecha de Realización</th>
                    <th>Repuestos</th>
                    <th>Próxima Fecha Mantenimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($maintenances as $maintenance)
                    <tr>
                        <td>{{ $maintenance->id }}</td>
                        <td>{{ $maintenance->asset->codigo }}</td>
                        <td>{{ $maintenance->description }}</td>
                        <td>{{ $maintenance->fecha_realizacion }}</td>
                        <td>{{ $maintenance->repuestos }}</td>
                        <td>{{ $maintenance->proxima_fecha_mantenimiento }}</td>
                        <td>
                            <a href="{{ route('maintenances.edit', $maintenance->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('maintenances.report', $maintenance->id) }}" class="btn btn-info btn-sm" title="Reporte PDF" target="_blank">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                            <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="POST" class="formEliminar d-inline" id="delete-form-{{ $maintenance->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $maintenances->links() }}
        </div>
    </div>
</div>
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  (function () {
    'use strict'

    var forms = document.querySelectorAll('.formEliminar')
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          event.preventDefault()
          event.stopPropagation()
          Swal.fire({
              title: '¿Desea eliminar el mantenimiento?',
              icon: 'info',
              showCancelButton: true,
              confirmButtonColor: '#20c997',
              cancelButtonColor: '#6c757d',
              confirmButtonText: 'Confirmar',
          }).then((result) => {
            if (result.isConfirmed) {
              this.submit();
              Swal.fire('Eliminado', 'El mantenimiento se eliminó correctamente.','success');
            }
          })
        }, false)
      });
  })()
</script>
@stop
