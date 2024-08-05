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
                <a href="{{route('locations.create')}}" class="btn btn-sm btn-success float-right">NUEVA LOCACIÓN</a>
            </div>

            <div class="card-body">
                <div id="list" class="dataTables_wrapper dt-bootstrap4">
                    @foreach($locations as $piso => $locaciones)
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Piso: {{ $piso }}</h3>
                                </div>
                                <div class="card-body">
                                    <table id="list-locations-{{ $piso }}" class="table table-bordered table-striped dataTable dtr-inline"
                                        aria-describedby="list-locations-{{ $piso }}">
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
                                            @foreach($locaciones as $location)
                                            <tr>
                                                <td>{{ $location->id }}</td>
                                                <td>{{ $location->direccion }}</td>
                                                <td>{{ $location->departamento->name ?? 'Desconocido' }}</td>
                                                <td>{{ $location->provincia->name ?? 'Desconocido' }}</td>
                                                <td>{{ $location->distrito->name ?? 'Desconocido' }}</td>
                                                <td>{{ $location->latitud }}</td>
                                                <td>{{ $location->longitud }}</td>
                                                <td style="display: inline-block; width: 110px;">
                                                    <a href="{{route('locations.edit',[$location->id])}}"
                                                        class="btn btn-sm btn-success float-left">Editar</a>
                                                    <form action="{{route('locations.destroy', $location->id)}}" method="post" class="delete-location">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
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
                    @endforeach
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
    text: '<?= session('successDel')  ?>',
    icon: "success"
});
</script>
@endif

@if(session('errorDel'))
<script>
Swal.fire({
    title: "Atencion!",
    text: '<?= session('errorDel')  ?>',
    icon: "warning"
});
</script>
@endif

<script>
$(function() {
    @foreach($locations as $piso => $locaciones)
    $("#list-locations-{{ $piso }}").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "search": "Pesquisar",
        "paginate": {
            "next": "Próximo",
            "previous": "Anterior",
            "first": "Primeiro",
            "last": "Último"
        },
        "language": {
            "url": '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
        },
    });
    @endforeach

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
