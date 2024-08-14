@extends('adminlte::page')

@section('title', 'Editar Mantenimiento')

@section('content_header')
    <h1>Editar Mantenimiento</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Mantenimiento</h3>
            </div>
            <div class="card-body">
                <!-- Mostrar mensajes de error -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('maintenances.update', $maintenance->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="asset_id">Bien Patrimonial:</label>
                        <input type="text" id="asset_id" name="asset_id" class="form-control" value="{{ old('asset_id', $maintenance->asset_id) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <textarea id="description" name="description" class="form-control" required>{{ old('description', $maintenance->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha_realizacion">Fecha de Realización:</label>
                        <input type="text" id="fecha_realizacion" name="fecha_realizacion" class="form-control" value="{{ old('fecha_realizacion', $maintenance->fecha_realizacion) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="repuestos">Repuestos:</label>
                        <input type="text" id="repuestos" name="repuestos" class="form-control" value="{{ old('repuestos', $maintenance->repuestos) }}">
                    </div>
                    <div class="form-group">
                        <label for="proxima_fecha_mantenimiento">Próxima Fecha de Mantenimiento:</label>
                        <input type="date" id="proxima_fecha_mantenimiento" name="proxima_fecha_mantenimiento" class="form-control" value="{{ old('proxima_fecha_mantenimiento', $maintenance->proxima_fecha_mantenimiento) }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('maintenances.index') }}" class="btn btn-secondary">Volver a la Lista</a>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
