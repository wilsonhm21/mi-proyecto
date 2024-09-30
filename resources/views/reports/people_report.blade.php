@extends('adminlte::page')

@section('title', 'Reporte de Personas')

@section('content_header')
    <h1>Reporte de Personas</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>DNI</th>
                    <th>Género</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Estado</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                </tr>
            </thead>
            <tbody>
                @if($peoples->isEmpty())
                    <tr>
                        <td colspan="10">No se encontraron registros.</td>
                    </tr>
                @else
                    @foreach($peoples as $person)
                    <tr>
                        <td>{{ $person->nombres }}</td>
                        <td>{{ $person->ape_paterno }}</td>
                        <td>{{ $person->ape_materno }}</td>
                        <td>{{ $person->dni }}</td>
                        <td>{{ $person->genero }}</td>
                        <td>{{ $person->fecha_nacimiento->format('d/m/Y') }}</td>
                        <td>{{ $person->estado }}</td>
                        <td>{{ $person->direccion }}</td>
                        <td>{{ $person->telefono }}</td>
                        <td>{{ $person->correo_electronico }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
