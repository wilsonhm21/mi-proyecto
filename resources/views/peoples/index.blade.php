@extends('adminlte::page')

@section('title', 'Listado de Personas')

@section('content_header')
    <h3>Listado de Personas</h3>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block">
                        <form method="GET" action="{{ route('peoples.index') }}" class="d-inline-block">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o DNI" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <a href="{{ route('peoples.create') }}" class="btn btn-primary">Nuevo Registro</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="card bg-success text-white">
                            <div class="card-header">
                                <h5 class="card-title">Personas Activas</h5>
                            </div>
                            <div class="card-body">
                                @foreach($activePeople as $person)
                                    <div class="mb-2">
                                        <strong>{{ $person->nombres }} {{ $person->ape_paterno }} {{ $person->ape_materno }}</strong>
                                        <p>DNI: {{ $person->dni }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-secondary text-white">
                            <div class="card-header">
                                <h5 class="card-title">Personas Inactivas</h5>
                            </div>
                            <div class="card-body">
                                @foreach($inactivePeople as $person)
                                    <div class="mb-2">
                                        <strong>{{ $person->nombres }} {{ $person->ape_paterno }} {{ $person->ape_materno }}</strong>
                                        <p>DNI: {{ $person->dni }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombres y apellidos</th>
                                <th>DNI</th>
                                <th>Género</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Estado</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Correo Electrónico</th>
                                <th>Departamento</th>
                                <th>Provincia</th>
                                <th>Distrito</th>
                                <th>Cargo</th>
                                <th>Departamento de Trabajo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peoples as $person)
                                <tr>
                                    <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">{{ $person->nombres }}, {{ $person->ape_paterno }} {{ $person->ape_materno }}</td>
                                    <td>{{ $person->dni }}</td>
                                    <td>{{ $person->genero == 'M' ? 'Masculino' : 'Femenino' }}</td>
                                    <td>{{ $person->fecha_nacimiento }}</td>
                                    <td>{{ $person->estado }}</td>
                                    <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">{{ $person->direccion }}</td>
                                    <td>{{ $person->telefono }}</td>
                                    <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">{{ $person->correo_electronico }}</td>
                                    <td>{{ $person->departamento->name?? 'Desconocido' }}</td>
                                    <td>{{ $person->provincia->name?? 'Desconocido' }}</td>
                                    <td>{{ $person->distrito->name?? 'Desconocido' }}</td>
                                    <td>{{ $person->position->nombre }}</td>
                                    <td>{{ $person->department->nombre }}</td>
                                    <td>
                                        <a href="{{ route('peoples.edit', $person->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('peoples.destroy', $person->id) }}" method="post" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Paginación -->
                <div class="mt-3">
                    {{ $peoples->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@stop
