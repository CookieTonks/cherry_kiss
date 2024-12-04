<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            text-align: center;
            width: 100%;
            font-size: 12px;
        }

        .content {
            margin: 20px;
        }

        .logo {
            max-width: 150px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Reporte de Datos</h1>
    </div>
    <div class="content">
        <p>Información dinámica:</p>
        <ul>
            @foreach($data as $key => $value)
            <li>{{ $key }}: {{ $value }}</li>
            @endforeach
        </ul>
    </div>
    <div class="footer">
        © {{ date('Y') }} - Todos los derechos estan reservados.
    </div>
</body>

</html>