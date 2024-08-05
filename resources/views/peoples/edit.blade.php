@extends('adminlte::page')

@section('title', 'Editar Persona')

@section('content_header')
    <h3>Editar Persona</h3>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('shared.error-message')
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Editar Persona</h3>
                </div>

                <form action="{{ route('peoples.update', $person->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nombres">Nombres</label>
                                <input type="text" class="form-control @error('nombres') is-invalid @enderror" name="nombres" id="nombres"
                                    placeholder="Ingrese los nombres" value="{{ old('nombres', $person->nombres) }}" required>
                                @error('nombres')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="ape_paterno">Apellido Paterno</label>
                                <input type="text" class="form-control @error('ape_paterno') is-invalid @enderror" name="ape_paterno" id="ape_paterno"
                                    placeholder="Ingrese el apellido paterno" value="{{ old('ape_paterno', $person->ape_paterno) }}" required>
                                @error('ape_paterno')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="ape_materno">Apellido Materno</label>
                                <input type="text" class="form-control @error('ape_materno') is-invalid @enderror" name="ape_materno" id="ape_materno"
                                    placeholder="Ingrese el apellido materno" value="{{ old('ape_materno', $person->ape_materno) }}" required>
                                @error('ape_materno')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="dni">DNI</label>
                                <input type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" id="dni"
                                    placeholder="Ingrese el DNI" value="{{ old('dni', $person->dni) }}" required>
                                @error('dni')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="genero">Género</label>
                                <select class="form-control @error('genero') is-invalid @enderror" name="genero" id="genero">
                                    <option value="">Seleccione</option>
                                    <option value="M" {{ old('genero', $person->genero) == 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('genero', $person->genero) == 'F' ? 'selected' : '' }}>Femenino</option>
                                </select>
                                @error('genero')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" id="fecha_nacimiento"
                                    value="{{ old('fecha_nacimiento', $person->fecha_nacimiento) }}" required>
                                @error('fecha_nacimiento')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="estado">Estado</label>
                                <select class="form-control @error('estado') is-invalid @enderror" name="estado" id="estado">
                                    <option value="">Seleccione</option>
                                    <option value="Activo" {{ old('estado', $person->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Inactivo" {{ old('estado', $person->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('estado')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" id="direccion"
                                    placeholder="Ingrese la dirección" value="{{ old('direccion', $person->direccion) }}" required>
                                @error('direccion')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" id="telefono"
                                    placeholder="Ingrese el teléfono" value="{{ old('telefono', $person->telefono) }}" required>
                                @error('telefono')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="correo_electronico">Correo Electrónico</label>
                                <input type="email" class="form-control @error('correo_electronico') is-invalid @enderror" name="correo_electronico" id="correo_electronico"
                                    placeholder="Ingrese el correo electrónico" value="{{ old('correo_electronico', $person->correo_electronico) }}" required>
                                @error('correo_electronico')
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
                                        <option value="{{ $departamento->id }}" {{ old('departamento_id', $person->departamento_id) == $departamento->id ? 'selected' : '' }}>
                                            {{ $departamento->name }}
                                        </option>
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
                                    @foreach($provincias as $provincia)
                                        <option value="{{ $provincia->id }}" {{ old('provincia_id', $person->provincia_id) == $provincia->id ? 'selected' : '' }}>
                                            {{ $provincia->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('provincia_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="distrito_id">Distrito</label>
                                <select class="form-control @error('distrito_id') is-invalid @enderror" name="distrito_id" id="distrito_id" disabled>
                                    <option value="">Seleccione</option>
                                    @foreach($distritos as $distrito)
                                        <option value="{{ $distrito->id }}" {{ old('distrito_id', $person->distrito_id) == $distrito->id ? 'selected' : '' }}>
                                            {{ $distrito->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('distrito_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="position_id">Cargo</label>
                                <select class="form-control @error('position_id') is-invalid @enderror" name="position_id" id="position_id">
                                    <option value="">Seleccione</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}" {{ old('position_id', $person->position_id) == $position->id ? 'selected' : '' }}>
                                            {{ $position->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('position_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="department_id">Departamento de Trabajo</label>
                                <select class="form-control @error('department_id') is-invalid @enderror" name="department_id" id="department_id">
                                    <option value="">Seleccione</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id', $person->department_id) == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                        <a href="{{ route('peoples.index') }}" class="btn btn-default">Cancelar</a>
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
            // Lógica para habilitar los campos de provincia y distrito según el departamento seleccionado
            $('#departamento_id').change(function(){
                var departamento_id = $(this).val();
                if(departamento_id) {
                    $.ajax({
                        url: '/get-provincias/' + departamento_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#provincia_id').prop('disabled', false).empty().append('<option value="">Seleccione</option>');
                            $.each(data, function(key, value){
                                $('#provincia_id').append('<option value="'+ key +'">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#provincia_id').prop('disabled', true).empty().append('<option value="">Seleccione</option>');
                }
            });

            $('#provincia_id').change(function(){
                var provincia_id = $(this).val();
                if(provincia_id) {
                    $.ajax({
                        url: '/get-distritos/' + provincia_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#distrito_id').prop('disabled', false).empty().append('<option value="">Seleccione</option>');
                            $.each(data, function(key, value){
                                $('#distrito_id').append('<option value="'+ key +'">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#distrito_id').prop('disabled', true).empty().append('<option value="">Seleccione</option>');
                }
            });
        });
    </script>
@stop
