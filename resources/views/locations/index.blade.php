@extends('adminlte::page')

@section('title', 'Locaciones')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        @include('shared.success-message')
        @include('shared.error-message')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Locaciones</h3>
                <a href="{{ route('locations.create') }}" class="btn btn-sm btn-success float-right">NUEVA LOCACIÓN</a>
            </div>

            <div class="card-body">
                <div id="list" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Todas las Locaciones</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-wrapper">
                                        <table id="list-locations" class="table table-bordered table-striped dataTable dtr-inline"
                                            aria-describedby="list-locations">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Dirección</th>
                                                    <th>Departamento</th>
                                                    <th>Provincia</th>
                                                    <th>Distrito</th>
                                                    <th>Latitud</th>
                                                    <th>Longitud</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($locations as $location)
                                                <tr>
                                                    <td>{{ $location->id }}</td>
                                                    <td>{{ $location->direccion }}</td>
                                                    <td>{{ $location->departamento->name ?? 'Desconocido' }}</td>
                                                    <td>{{ $location->provincia->name ?? 'Desconocido' }}</td>
                                                    <td>{{ $location->distrito->name ?? 'Desconocido' }}</td>
                                                    <td>{{ $location->latitud }}</td>
                                                    <td>{{ $location->longitud }}</td>
                                                    <td style="width: 110px;">
                                                        <a href="{{ route('locations.edit', [$location->id]) }}" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        <form action="{{ route('locations.destroy', $location->id) }}" method="post" class="delete-location d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

@if(session('successDel'))
<script>
Swal.fire({
    title: "Excluido!",
    text: '{{ session('successDel') }}',
    icon: "success"
});
</script>
@endif

@if(session('errorDel'))
<script>
Swal.fire({
    title: "Atencion!",
    text: '{{ session('errorDel') }}',
    icon: "warning"
});
</script>
@endif

<script>
$(function() {
    $("#list-locations").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "scrollX": true,
        "language": {
            "url": '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
        },
    });

    $('.delete-location').submit(function(ev) {
        ev.preventDefault();

        Swal.fire({
            title: "¿Está seguro de que desea eliminar?",
            text: "El registro se eliminará!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, excluir!"
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
});
</script>

@stop
