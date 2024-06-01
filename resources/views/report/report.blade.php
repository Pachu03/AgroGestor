<!DOCTYPE html>
<html>

<head>
    <title>Informe de Cosecha</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Informe de Cosecha</h1>
        <table>
            <tr>
                <th>Fecha de Recolección</th>
                <td>{{ $cosecha->date_collection }}</td>
            </tr>
            <tr>
                <th>Cantidad Recogida</th>
                <td>{{ $cosecha->quantity_collection }}</td>
            </tr>
            <tr>
                <th>Producto</th>
                <td>{{ $cosecha->product->name }}</td>
            </tr>
            <tr>
                <th>Grupo</th>
                <td>{{ $cosecha->group->name }}</td>
            </tr>
            <tr>
                <th>Usuario</th>
                <td>{{ $cosecha->user->name }}</td>
            </tr>
        </table>
    </div>
</body>

</html>