@extends('adminlte::page')

@section('title', 'Nuevo Departamento')

@section('content_header')
<h3>Nuevo Departamento</h3>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nuevo Departamento</h3>
            </div>

            <form action="{{ route('departments.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre"
                                placeholder="Ingrese el nombre del departamento" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" id="descripcion"
                                placeholder="Ingrese la descripción" value="{{ old('descripcion') }}" required>
                            @error('descripcion')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="piso">Piso</label>
                            <input type="text" class="form-control @error('piso') is-invalid @enderror" name="piso" id="piso"
                                placeholder="Ingrese el piso del departamento" value="{{ old('piso') }}" required>
                            @error('piso')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="location_id">Ubicación</label>
                            <select class="form-control @error('location_id') is-invalid @enderror" name="location_id" id="location_id">
                                <option value="">Seleccione una ubicación</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                        {{ $location->direccion }}
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
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('departments.index') }}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
