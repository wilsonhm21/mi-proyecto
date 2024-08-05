@extends('adminlte::page')

@section('title', 'Editar Ubicación')

@section('content_header')
    <h1>Editar Ubicación</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('locations.update', $location->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $location->direccion }}" required>
                        </div>
                        <div class="form-group">
                            <label for="piso">Piso:</label>
                            <input type="text" name="piso" id="piso" class="form-control" value="{{ $location->piso }}" required>
                        </div>
                        <div class="form-group">
                            <label for="distrito_id">Distrito:</label>
                            <input type="text" name="distrito_id" id="distrito_id" class="form-control" value="{{ $location->distrito_id }}" required>
                        </div>
                        <div class="form-group">
                            <label for="provincia_id">Provincia:</label>
                            <input type="text" name="provincia_id" id="provincia_id" class="form-control" value="{{ $location->provincia_id }}" required>
                        </div>
                        <div class="form-group">
                            <label for="departamento_id">Departamento:</label>
                            <input type="text" name="departamento_id" id="departamento_id" class="form-control" value="{{ $location->departamento_id }}" required>
                        </div>
                        <div class="form-group">
                            <label for="latitud">Latitud:</label>
                            <input type="text" name="latitud" id="latitud" class="form-control" value="{{ $location->latitud }}">
                        </div>
                        <div class="form-group">
                            <label for="longitud">Longitud:</label>
                            <input type="text" name="longitud" id="longitud" class="form-control" value="{{ $location->longitud }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="{{ route('locations.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Agregar estilos personalizados aquí --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
