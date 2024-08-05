@extends('adminlte::page')

@section('title', 'Detalles de Persona')

@section('content_header')
    <h1>Detalles de Persona</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalles de Persona</h3>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9">{{ $people->id }}</dd>

                <dt class="col-sm-3">Nombres</dt>
                <dd class="col-sm-9">{{ $people->nombres }}</dd>

                <dt class="col-sm-3">Apellido Paterno</dt>
                <dd class="col-sm-9">{{ $people->ape_paterno }}</dd>

                <dt class="col-sm-3">Apellido Materno</dt>
                <dd class="col-sm-9">{{ $people->ape_materno }}</dd>

                <dt class="col-sm-3">DNI</dt>
                <dd class="col-sm-9">{{ $people->dni }}</dd>

                <dt class="col-sm-3">Género</dt>
                <dd class="col-sm-9">{{ $people->genero }}</dd>

                <dt class="col-sm-3">Fecha de Nacimiento</dt>
                <dd class="col-sm-9">{{ $people->fecha_nacimiento }}</dd>

                <dt class="col-sm-3">Estado</dt>
                <dd class="col-sm-9">{{ $people->estado }}</dd>

                <dt class="col-sm-3">Dirección</dt>
                <dd class="col-sm-9">{{ $people->direccion }}</dd>

                <dt class="col-sm-3">Teléfono</dt>
                <dd class="col-sm-9">{{ $people->telefono }}</dd>

                <dt class="col-sm-3">Correo Electrónico</dt>
                <dd class="col-sm-9">{{ $people->correo_electronico }}</dd>

                <dt class="col-sm-3">Distrito</dt>
                <dd class="col-sm-9">{{ $people->distrito_id }}</dd>

                <dt class="col-sm-3">Provincia</dt>
                <dd class="col-sm-9">{{ $people->provincia_id }}</dd>

                <dt class="col-sm-3">Departamento</dt>
                <dd class="col-sm-9">{{ $people->departamento_id }}</dd>

                <dt class="col-sm-3">Department ID</dt>
                <dd class="col-sm-9">{{ $people->department_id }}</dd>

                <dt class="col-sm-3">Position ID</dt>
                <dd class="col-sm-9">{{ $people->position_id }}</dd>
            </dl>
        </div>
    </div>
@stop
