<!DOCTYPE html>
<html>
<head>
    <title>Listado de Personas</title>
    <style>
        /* Puedes agregar estilos para el PDF aquí */
    </style>
</head>
<body>
    <h1>Listado de Personas</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>DNI</th>
                <th>Género</th>
                <th>Fecha de Nacimiento</th>
                <th>Estado</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo Electrónico</th>
                <th>Distrito</th>
                <th>Provincia</th>
                <th>Departamento</th>
                <th>Departamento ID</th>
                <th>Position ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peoples as $people)
                <tr>
                    <td>{{ $people->id }}</td>
                    <td>{{ $people->nombres }}</td>
                    <td>{{ $people->ape_paterno }}</td>
                    <td>{{ $people->ape_materno }}</td>
                    <td>{{ $people->dni }}</td>
                    <td>{{ $people->genero }}</td>
                    <td>{{ $people->fecha_nacimiento }}</td>
                    <td>{{ $people->estado }}</td>
                    <td>{{ $people->direccion }}</td>
                    <td>{{ $people->telefono }}</td>
                    <td>{{ $people->correo_electronico }}</td>
                    <td>{{ $people->distrito_id }}</td>
                    <td>{{ $people->provincia_id }}</td>
                    <td>{{ $people->departamento_id }}</td>
                    <td>{{ $people->department_id }}</td>
                    <td>{{ $people->position_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
