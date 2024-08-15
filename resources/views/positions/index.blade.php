@extends('adminlte::page')

@section('title', 'Posiciones')

@section('content_header')
    <h1>Cargos</h1>
@stop

@section('content')

<div class="row mb-3">
    <div class="col-md-12">
        @include('shared.success-message')
        @include('shared.error-message')
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Lista de Cargos</h3>
            <div class="d-flex">
                <form method="GET" action="{{ route('positions.index') }}" class="d-inline-block mr-2">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar por nombre" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('positions.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Cargo
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Departamento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($positions as $position)
                    <tr>
                        <td>{{ $position->id }}</td>
                        <td>{{ $position->nombre }}</td>
                        <td>{{ $position->fecha_inicio }}</td>
                        <td>{{ $position->fecha_fin }}</td>
                        <td>{{ $position->department ? $position->department->nombre : 'No asignado' }}</td>
                        <td>
                            <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('positions.destroy', $position->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta posición?');">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@section('js')
<script>
    // Mostrar alertas nativas
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            alert('{{ session('success') }}');
        @endif

        @if(session('error'))
            alert('{{ session('error') }}');
        @endif
    });
</script>
@stop
