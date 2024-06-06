<!DOCTYPE html>
<html>

<head>
    <title>@lang('Harvest Report') </title>
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
        <h1>@lang('Harvest Report')</h1>
        <table>
            <tr>
                <th>@lang('Harvest Date')</th>
                <td>{{ $collection->date_collection }}</td>
            </tr>
            <tr>
                <th>@lang('Collected Quantity')</th>
                <td>{{ $collection->quantity_collection }}</td>
            </tr>
            <tr>
                <th>@lang('Product')</th>
                <td>{{ $collection->product->name }}</td>
            </tr>
            <tr>
                <th>@lang('Group')</th>
                <td>{{ $collection->group->name }}</td>
            </tr>
            <tr>
                <th>@lang('User')</th>
                <td>{{ $collection->user->name }}</td>
            </tr>
        </table>
    </div>
    @include('components.footer')
</body>

</html>
