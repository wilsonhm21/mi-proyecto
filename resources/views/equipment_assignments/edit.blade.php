@extends('adminlte::page')

@section('title', 'Editar Asignación de Equipo')

@section('content_header')
    <h1>Editar Asignación de Equipo</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Asignación de Equipo</h3>
            </div>
            <form action="{{ route('equipment_assignments.update', $assignment->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="asset_id">Código de Equipo</label>
                        <select name="asset_id" id="asset_id" class="form-control">
                            @foreach($assets as $asset)
                                <option value="{{ $asset->id }}" {{ $asset->id == $assignment->asset_id ? 'selected' : '' }}>{{ $asset->codigo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha_asignacion">Fecha de Asignación</label>
                        <input type="date" name="fecha_asignacion" id="fecha_asignacion" class="form-control" value="{{ old('fecha_asignacion', $assignment->fecha_asignacion) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_devolucion">Fecha de Devolución</label>
                        <input type="date" name="fecha_devolucion" id="fecha_devolucion" class="form-control" value="{{ old('fecha_devolucion', $assignment->fecha_devolucion) }}">
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" name="estado" id="estado" class="form-control" value="{{ old('estado', $assignment->estado) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="department_id">Departamento</label>
                        <select name="department_id" id="department_id" class="form-control">
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ $department->id == $assignment->department_id ? 'selected' : '' }}>{{ $department->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="people_id">Persona</label>
                        <select name="people_id" id="people_id" class="form-control">
                            @foreach($peoples as $people)
                                <option value="{{ $people->id }}" {{ $people->id == $assignment->people_id ? 'selected' : '' }}>{{ $people->nombres }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('equipment_assignments.index') }}" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
