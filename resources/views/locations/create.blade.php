@extends('adminlte::page')

@section('title', 'Nueva Locación')

@section('content_header')
<h3>Nueva Locación</h3>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nueva Locación</h3>
            </div>

            <form action="{{ route('locations.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" id="direccion"
                                placeholder="Ingrese la dirección" value="{{ old('direccion') }}" required>
                            @error('direccion')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="piso">Piso</label>
                            <input type="text" class="form-control @error('piso') is-invalid @enderror" name="piso" id="piso"
                                placeholder="Ingrese el piso" value="{{ old('piso') }}" required>
                            @error('piso')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="departamento_id">Departamento</label>
                            <select class="form-control @error('departamento_id') is-invalid @enderror" name="departamento_id" id="departamento_id">
                                <option value="">Seleccione</option>
                                @foreach($departamentos as $departamento)
                                    <option value="{{ $departamento->id }}">{{ $departamento->name }}</option>
                                @endforeach
                            </select>
                            @error('departamento_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="provincia_id">Provincia</label>
                            <select class="form-control @error('provincia_id') is-invalid @enderror" name="provincia_id" id="provincia_id" disabled>
                                <option value="">Seleccione</option>
                                {{-- Las opciones se llenarán dinámicamente con JavaScript --}}
                            </select>
                            @error('provincia_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="distrito_id">Distrito</label>
                            <select class="form-control @error('distrito_id') is-invalid @enderror" name="distrito_id" id="distrito_id" disabled>
                                <option value="">Seleccione</option>
                                {{-- Las opciones se llenarán dinámicamente con JavaScript --}}
                            </select>
                            @error('distrito_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="latitud">Latitud</label>
                            <input type="text" class="form-control @error('latitud') is-invalid @enderror" name="latitud" id="latitud"
                                placeholder="Ingrese la latitud" value="{{ old('latitud') }}">
                            @error('latitud')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="longitud">Longitud</label>
                            <input type="text" class="form-control @error('longitud') is-invalid @enderror" name="longitud" id="longitud"
                                placeholder="Ingrese la longitud" value="{{ old('longitud') }}">
                            @error('longitud')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('locations.index') }}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#departamento_id').on('change', function() {
                var departamento_id = $(this).val();
                if(departamento_id) {
                    $.ajax({
                        url: '/provincias/'+departamento_id,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#provincia_id').empty();
                            $('#provincia_id').append('<option value="">Seleccione</option>');
                            $.each(data, function(key, value) {
                                $('#provincia_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                            $('#provincia_id').prop('disabled', false);
                            $('#distrito_id').empty();
                            $('#distrito_id').append('<option value="">Seleccione</option>');
                            $('#distrito_id').prop('disabled', true);
                        }
                    });
                } else {
                    $('#provincia_id').empty();
                    $('#provincia_id').append('<option value="">Seleccione</option>');
                    $('#provincia_id').prop('disabled', true);
                    $('#distrito_id').empty();
                    $('#distrito_id').append('<option value="">Seleccione</option>');
                    $('#distrito_id').prop('disabled', true);
                }
            });

            $('#provincia_id').on('change', function() {
                var provincia_id = $(this).val();
                if(provincia_id) {
                    $.ajax({
                        url: '/distritos/'+provincia_id,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#distrito_id').empty();
                            $('#distrito_id').append('<option value="">Seleccione</option>');
                            $.each(data, function(key, value) {
                                $('#distrito_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                            $('#distrito_id').prop('disabled', false);
                        }
                    });
                } else {
                    $('#distrito_id').empty();
                    $('#distrito_id').append('<option value="">Seleccione</option>');
                    $('#distrito_id').prop('disabled', true);
                }
            });
        });
    </script>
@stop
