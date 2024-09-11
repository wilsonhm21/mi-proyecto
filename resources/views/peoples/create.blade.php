@extends('adminlte::page')

@section('title', 'Nuevo Registro de Persona')

@section('content_header')
<h3>Nuevo Registro de Persona</h3>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nuevo Registro de Persona</h3>
            </div>

            <form action="{{ route('peoples.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nombres">Nombres</label>
                            <input type="text" class="form-control @error('nombres') is-invalid @enderror" name="nombres" id="nombres"
                                placeholder="Ingrese los nombres" value="{{ old('nombres') }}" required>
                            @error('nombres')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="ape_paterno">Apellido Paterno</label>
                            <input type="text" class="form-control @error('ape_paterno') is-invalid @enderror" name="ape_paterno" id="ape_paterno"
                                placeholder="Ingrese el apellido paterno" value="{{ old('ape_paterno') }}" required>
                            @error('ape_paterno')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="ape_materno">Apellido Materno</label>
                            <input type="text" class="form-control @error('ape_materno') is-invalid @enderror" name="ape_materno" id="ape_materno"
                                placeholder="Ingrese el apellido materno" value="{{ old('ape_materno') }}" required>
                            @error('ape_materno')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="dni">DNI</label>
                            <input type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" id="dni"
                                placeholder="Ingrese el DNI" value="{{ old('dni') }}" required>
                            @error('dni')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="genero">Género</label>
                            <select class="form-control @error('genero') is-invalid @enderror select2" name="genero" id="genero">
                                <option value="">Seleccione</option>
                                <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('genero') == 'F' ? 'selected' : '' }}>Femenino</option>
                            </select>
                            @error('genero')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" id="fecha_nacimiento"
                                value="{{ old('fecha_nacimiento') }}" required>
                            @error('fecha_nacimiento')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="estado">Estado</label>
                            <select class="form-control @error('estado') is-invalid @enderror select2" name="estado" id="estado">
                                <option value="">Seleccione</option>
                                <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" id="direccion"
                                placeholder="Ingrese la dirección" value="{{ old('direccion') }}" required>
                            @error('direccion')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" id="telefono"
                                placeholder="Ingrese el teléfono" value="{{ old('telefono') }}" required>
                            @error('telefono')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="correo_electronico">Correo Electrónico</label>
                            <input type="email" class="form-control @error('correo_electronico') is-invalid @enderror" name="correo_electronico" id="correo_electronico"
                                placeholder="Ingrese el correo electrónico" value="{{ old('correo_electronico') }}" required>
                            @error('correo_electronico')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="departamento_id">Departamento</label>
                            <select class="form-control @error('departamento_id') is-invalid @enderror select2" name="departamento_id" id="departamento_id">
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
                            <select class="form-control @error('provincia_id') is-invalid @enderror select2" name="provincia_id" id="provincia_id" disabled>
                                <option value="">Seleccione</option>
                                {{-- Las opciones se llenarán dinámicamente con JavaScript --}}
                            </select>
                            @error('provincia_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="distrito_id">Distrito</label>
                            <select class="form-control @error('distrito_id') is-invalid @enderror select2" name="distrito_id" id="distrito_id" disabled>
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
                            <label for="position_id">Cargo</label>
                            <select class="form-control @error('position_id') is-invalid @enderror select2" name="position_id" id="position_id">
                                <option value="">Seleccione</option>
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->nombre }}</option>
                                @endforeach
                            </select>
                            @error('position_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="department_id">Departamento de Trabajo</label>
                            <select class="form-control @error('department_id') is-invalid @enderror select2" name="department_id" id="department_id">
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

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('peoples.index') }}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('css')
    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        .form-control, .select2-container--default .select2-selection--single {
            box-sizing: border-box;
        }
    </style>
@stop

@section('js')
    <!-- Include jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            // Initialize Select2 for all select elements
            $('.select2').select2({
                width: '100%',
                placeholder: "Seleccione",
                allowClear: true
            });

            // Handle changes in departamento_id to update provincia_id and distrito_id
            $('#departamento_id').on('change', function() {
                var departamento_id = $(this).val();
                if(departamento_id) {
                    $.ajax({
                        url: '/provincias/'+departamento_id,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#provincia_id').empty().append('<option value="">Seleccione</option>');
                            $.each(data, function(key, value) {
                                $('#provincia_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                            $('#provincia_id').prop('disabled', false).trigger('change');
                            $('#distrito_id').empty().append('<option value="">Seleccione</option>').prop('disabled', true);
                        }
                    });
                } else {
                    $('#provincia_id').empty().append('<option value="">Seleccione</option>').prop('disabled', true);
                    $('#distrito_id').empty().append('<option value="">Seleccione</option>').prop('disabled', true);
                }
            });

            // Handle changes in provincia_id to update distrito_id
            $('#provincia_id').on('change', function() {
                var provincia_id = $(this).val();
                if(provincia_id) {
                    $.ajax({
                        url: '/distritos/'+provincia_id,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#distrito_id').empty().append('<option value="">Seleccione</option>');
                            $.each(data, function(key, value) {
                                $('#distrito_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                            $('#distrito_id').prop('disabled', false);
                        }
                    });
                } else {
                    $('#distrito_id').empty().append('<option value="">Seleccione</option>').prop('disabled', true);
                }
            });
        });
    </script>
@stop
