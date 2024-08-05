@extends('adminlte::page')

@section('title', 'Editar Activo')

@section('content_header')
    <h1>Editar Activo</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Activo</h3>
            </div>

            <form action="{{ route('assets.update', $asset->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="codigo">Código</label>
                            <input type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" id="codigo" placeholder="Ingrese el código" value="{{ old('codigo', $asset->codigo) }}" required>
                            @error('codigo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" placeholder="Ingrese el nombre" value="{{ old('nombre', $asset->nombre) }}" required>
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="marca">Marca</label>
                            <input type="text" class="form-control @error('marca') is-invalid @enderror" name="marca" id="marca" placeholder="Ingrese la marca" value="{{ old('marca', $asset->marca) }}" required>
                            @error('marca')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="modelo">Modelo</label>
                            <input type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo" id="modelo" placeholder="Ingrese el modelo" value="{{ old('modelo', $asset->modelo) }}" required>
                            @error('modelo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="numero_serie">Número de Serie</label>
                            <input type="text" class="form-control @error('numero_serie') is-invalid @enderror" name="numero_serie" id="numero_serie" placeholder="Ingrese el número de serie" value="{{ old('numero_serie', $asset->numero_serie) }}" required>
                            @error('numero_serie')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="fecha_registro">Fecha de Registro</label>
                            <input type="date" class="form-control @error('fecha_registro') is-invalid @enderror" name="fecha_registro" id="fecha_registro" value="{{ old('fecha_registro', $asset->fecha_registro) }}" required>
                            @error('fecha_registro')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="estado_actual">Estado Actual</label>
                            <select class="form-control @error('estado_actual') is-invalid @enderror" name="estado_actual" id="estado_actual">
                                <option value="">Seleccione</option>
                                <option value="Activo" {{ old('estado_actual', $asset->estado_actual) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado_actual', $asset->estado_actual) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado_actual')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="imagen">Imagen</label>
                            <input type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen" id="imagen">
                            @error('imagen')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @if($asset->imagen)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $asset->imagen) }}" alt="Imagen Actual" class="img-thumbnail" width="100">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" id="descripcion" rows="3" placeholder="Ingrese una descripción">{{ old('descripcion', $asset->descripcion) }}</textarea>
                            @error('descripcion')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="location_id">Ubicación</label>
                            <select class="form-control @error('location_id') is-invalid @enderror" name="location_id" id="location_id">
                                <option value="">Seleccione</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('location_id', $asset->location_id) == $location->id ? 'selected' : '' }}>
                                        {{ $location->direccion }} - {{ $location->piso }} - {{ $location->departamento }}
                                    </option>
                                @endforeach
                            </select>
                            @error('location_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('assets.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
