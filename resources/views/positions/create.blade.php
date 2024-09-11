@extends('adminlte::page')

@section('title', 'Crear Posición')

@section('content_header')
    <h1>Crear Nuevo Cargo</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            @include('shared.error-message')
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Nuevo Cargo</h3>
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
                            <label for="fecha_fin">Fecha de Fin (opcional)</label>
                            <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin') }}">
                            @error('fecha_fin')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="contrato_indefinido" name="contrato_indefinido" {{ old('contrato_indefinido') ? 'checked' : '' }}>
                                <label class="form-check-label" for="contrato_indefinido">Contrato Indefinido</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="department_id">Departamento de Trabajo</label>
                            <select class="form-control select2 @error('department_id') is-invalid @enderror" name="department_id" id="department_id" required>
                                <option value="">Seleccione un departamento</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->nombre }}
                                    </option>
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

@section('css')
    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Ensure Select2 is responsive */
        .select2-container {
            width: 100% !important;
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
            // Initialize Select2 for department field
            $('#department_id').select2({
                placeholder: "Seleccione un departamento",
                allowClear: true
            });

            // Toggle visibility of 'fecha_fin' based on 'contrato_indefinido' checkbox
            $('#contrato_indefinido').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#fecha_fin').val('').hide();
                } else {
                    $('#fecha_fin').show();
                }
            }).trigger('change'); // Trigger change on page load to set the initial state
        });
    </script>
@stop
