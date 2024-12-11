<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Presupuesto #{{ $budget->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .items-table th {
            background-color: #f4f4f4;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Cotizacion #{{ $budget->codigo }}</h1>
        <p>{{ $budget->nombre_cliente }}</p>
        <p>{{ $budget->fecha }}</p>
    </div>
    <table class="items-table">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->descripcion }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>${{ number_format($item->precio_unitario, 2) }}</td>
                <td>${{ number_format($item->cantidad * $item->precio_unitario, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <p>Total: {{$budget->monto }}</p>
        <p>Gracias por su preferencia.</p>
    </div>
</body>

</html>