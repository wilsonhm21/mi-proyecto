@extends('adminlte::page')

@section('title', 'Listado de Personas')

@section('content_header')
    <h3>Listado de Personas</h3>
    <form method="GET" action="{{ route('peoples.index') }}" class="d-inline-block">
        <div class="d-flex align-items-center">
            <!-- Selector de Periodo -->
            <div class="form-group mb-0 mr-3">
                <label for="year" class="sr-only">Periodo:</label>
                <select id="year" name="year" class="form-control form-control-sm">
                    <option value="">Periodo</option>
                    @for($i = 2020; $i <= 2027; $i++)
                        <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
    </form>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Formulario de Búsqueda -->
                    <form method="GET" action="{{ route('peoples.index') }}" class="d-inline-block">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o DNI" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success">Buscar</button>
                            </div>
                        </div>
                    </form>
                    <!-- Botón Nuevo Registro -->
                    <a href="{{ route('peoples.create') }}" class="btn btn-primary">Nuevo Registro</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombres y apellidos</th>
                                <th>DNI</th>
                                <th>Género</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Estado</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Correo Electrónico</th>
                                <th>Departamento</th>
                                <th>Provincia</th>
                                <th>Distrito</th>
                                <th>Cargo</th>
                                <th>Departamento de Trabajo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peoples as $person)
                                <tr>
                                    <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                        <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailsModal"
                                           data-name="{{ $person->nombres }}, {{ $person->ape_paterno }} {{ $person->ape_materno }}"
                                           data-dni="{{ $person->dni }}"
                                           data-genero="{{ $person->genero == 'M' ? 'Masculino' : 'Femenino' }}"
                                           data-fecha_nacimiento="{{ $person->fecha_nacimiento }}"
                                           data-estado="{{ $person->estado }}"
                                           data-direccion="{{ $person->direccion }}"
                                           data-telefono="{{ $person->telefono }}"
                                           data-correo="{{ $person->correo_electronico }}"
                                           data-departamento="{{ $person->departamento->name ?? 'Desconocido' }}"
                                           data-provincia="{{ $person->provincia->name ?? 'Desconocido' }}"
                                           data-distrito="{{ $person->distrito->name ?? 'Desconocido' }}"
                                           data-cargo="{{ $person->position->nombre }}"
                                           data-departamento_trabajo="{{ $person->department->nombre }}"
                                           data-profile-picture="{{ asset('images/profiles/' . $person->profile_picture) }}">
                                            {{ $person->nombres }}, {{ $person->ape_paterno }} {{ $person->ape_materno }}
                                        </a>
                                    </td>
                                    <td>{{ $person->dni }}</td>
                                    <td>{{ $person->genero == 'M' ? 'Masculino' : 'Femenino' }}</td>
                                    <td>{{ $person->fecha_nacimiento }}</td>
                                    <td>{{ $person->estado }}</td>
                                    <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">{{ $person->direccion }}</td>
                                    <td>{{ $person->telefono }}</td>
                                    <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">{{ $person->correo_electronico }}</td>
                                    <td>{{ $person->departamento->name ?? 'Desconocido' }}</td>
                                    <td>{{ $person->provincia->name ?? 'Desconocido' }}</td>
                                    <td>{{ $person->distrito->name ?? 'Desconocido' }}</td>
                                    <td>{{ $person->position->nombre }}</td>
                                    <td>{{ $person->department->nombre }}</td>
                                    <td>
                                        <a href="{{ route('peoples.edit', $person->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('peoples.destroy', $person->id) }}" method="post" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Paginación -->
                <div class="mt-3">
                    {{ $peoples->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="detailsModalLabel">Ficha de empleado/a: <span id="modal-name"></span></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="" alt="Foto de Perfil" class="img-thumbnail" id="modal-profile-picture">
                    </div>
                    <div class="col-md-8">
                        <p><strong>Nombre Completo:</strong> <span id="modal-name"></span></p>
                        <p><strong>DNI:</strong> <span id="modal-dni"></span></p>
                        <p><strong>Género:</strong> <span id="modal-genero"></span></p>
                        <p><strong>Fecha de Nacimiento:</strong> <span id="modal-fecha_nacimiento"></span></p>
                        <p><strong>Estado:</strong> <span id="modal-estado"></span></p>
                        <p><strong>Dirección:</strong> <span id="modal-direccion"></span></p>
                        <p><strong>Teléfono:</strong> <span id="modal-telefono"></span></p>
                        <p><strong>Correo Electrónico:</strong> <span id="modal-correo"></span></p>
                    </div>
                </div>
                <hr>
                <p><strong>Departamento:</strong> <span id="modal-departamento"></span></p>
                <p><strong>Provincia:</strong> <span id="modal-provincia"></span></p>
                <p><strong>Distrito:</strong> <span id="modal-distrito"></span></p>
                <p><strong>Cargo:</strong> <span id="modal-cargo"></span></p>
                <p><strong>Departamento de Trabajo:</strong> <span id="modal-departamento_trabajo"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/js/all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('#detailsModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);

            modal.find('#modal-name').text(button.data('name'));
            modal.find('#modal-dni').text(button.data('dni'));
            modal.find('#modal-genero').text(button.data('genero'));
            modal.find('#modal-fecha_nacimiento').text(button.data('fecha_nacimiento'));
            modal.find('#modal-estado').text(button.data('estado'));
            modal.find('#modal-direccion').text(button.data('direccion'));
            modal.find('#modal-telefono').text(button.data('telefono'));
            modal.find('#modal-correo').text(button.data('correo'));
            modal.find('#modal-departamento').text(button.data('departamento'));
            modal.find('#modal-provincia').text(button.data('provincia'));
            modal.find('#modal-distrito').text(button.data('distrito'));
            modal.find('#modal-cargo').text(button.data('cargo'));
            modal.find('#modal-departamento_trabajo').text(button.data('departamento_trabajo'));

            var imageUrl = button.data('profile-picture');
            if (imageUrl) {
                modal.find('#modal-profile-picture').attr('src', imageUrl);
            } else {
                modal.find('#modal-profile-picture').attr('src', '/ruta/a/imagen/default.jpg');
            }
        });
    });
</script>
@stop
