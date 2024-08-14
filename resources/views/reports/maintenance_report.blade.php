<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Mantenimiento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .signature-section {
            margin-top: 40px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }
        .signature-content {
            width: 70%;
        }
        .signature-label {
            margin-bottom: 5px;
        }
        .signature-date {
            display: inline;
        }
        .signature-line {
            border-top: 1px solid #000;
            height: 20px; /* Ajustar la altura de las líneas de firma */
            margin-bottom: 5px; /* Espacio entre las líneas de firma */
        }
        .fingerprint-box {
            width: 30%;
            border: 1px solid #ddd;
            height: 100px;
            box-sizing: border-box;
            padding: 10px;
            text-align: center;
            line-height: 80px; /* Centrar el texto verticalmente */
            position: relative;
        }
        .fingerprint-label {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Reporte de Mantenimiento</h1>
    <table>
        <tr>
            <th>ID</th>
            <td>{{ $maintenance->id }}</td>
        </tr>
        <tr>
            <th>Bien Patrimonial</th>
            <td>{{ $maintenance->asset->codigo }}</td>
        </tr>
        <tr>
            <th>Descripción</th>
            <td>{{ $maintenance->description }}</td>
        </tr>
        <tr>
            <th>Fecha de Realización</th>
            <td>{{ $maintenance->fecha_realizacion }}</td>
        </tr>
        <tr>
            <th>Repuestos</th>
            <td>{{ $maintenance->repuestos }}</td>
        </tr>
        <tr>
            <th>Próxima Fecha Mantenimiento</th>
            <td>{{ $maintenance->proxima_fecha_mantenimiento }}</td>
        </tr>
    </table>

    <!-- Sección de firmas -->
    <div class="signature-section">
        <div class="signature-content">
            <div class="signature-label">
                <p>Firma del Responsable:</p>
                <div class="signature-line"></div>
            </div>
            <div class="signature-label">
                <p>Nombre del Responsable:</p>
                <div class="signature-line"></div>
            </div>
            <div class="signature-label">
                <p>Fecha: <span class="signature-date">{{ now()->format('d/m/Y') }}</span></p>
            </div>
        </div>
        <div class="fingerprint-box">
            <!-- Este div actúa como el cuadro para la huella digital -->
            <div class="fingerprint-label">Huella Digital</div>
        </div>
    </div>
</body>
</html>
