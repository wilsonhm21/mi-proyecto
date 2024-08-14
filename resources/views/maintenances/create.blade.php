@extends('adminlte::page')

@section('title', 'Crear Mantenimiento')

@section('content_header')
    <h1>Crear Mantenimiento</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nuevo Mantenimiento</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('maintenances.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="asset_id">Código de Equipo:</label>
                            <select name="asset_id" id="asset_id" class="form-control">
                                <option value="">Seleccione el Codigo</option>
                                @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}">{{ $asset->codigo }}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <textarea id="description" name="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha_realizacion">Fecha de Realización:</label>
                        <input type="date" id="fecha_realizacion" name="fecha_realizacion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="repuestos">Repuestos:</label>
                        <input type="text" id="repuestos" name="repuestos" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="proxima_fecha_mantenimiento">Próxima Fecha de Mantenimiento:</label>
                        <input type="date" id="proxima_fecha_mantenimiento" name="proxima_fecha_mantenimiento" class="form-control"required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('maintenances.index') }}" class="btn btn-secondary">Volver a la Lista</a>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
