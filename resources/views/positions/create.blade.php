@extends('adminlte::page')

@section('title', 'Crear Posición')

@section('content_header')
    <h1>Crear Nueva Posición</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            @include('shared.error-message')
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Nueva Posición</h3>
                </div>
                <form action="{{ route('positions.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" placeholder="Ingrese el nombre" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio</label>
                            <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
                            @error('fecha_inicio')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fecha_fin">Fecha de Fin</label>
                            <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin') }}" required>
                            @error('fecha_fin')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="department_id">Departamento</label>
                            <select class="form-control @error('department_id') is-invalid @enderror" name="department_id" id="department_id" required>
                                <option value="">Seleccione</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->nombre }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <a href="{{ route('positions.index') }}" type="button" class="btn btn-default">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
