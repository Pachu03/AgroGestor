@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Informe de Cosecha</h1>
        <table class="table">
            <tr>
                <th>Fecha de Recolección</th>
                <td>{{ $collection->date_collection }}</td>
            </tr>
            <tr>
                <th>Cantidad Recogida</th>
                <td>{{ $collection->quantity_collection }} kg</td>
            </tr>
            <tr>
                <th>Producto</th>
                <td>{{ $collection->product->name }}</td>
            </tr>
            <tr>
                <th>Grupo e Integrantes</th>
                <td>
                    {{ $collection->group->name }}<br>
                    @foreach ($collection->group->users as $user)
                        {{ $user->name }}<br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>Jefe</th>
                <td>{{ $collection->user->name }}</td>
            </tr>
        </table>

        <div class="mt-4">
            <form method="POST" action="{{ route('report.generate') }}">
                @csrf
                <input type="hidden" name="harvest_id" value="{{ $collection->id }}">
                <button type="submit" name="action" value="download" class="btn btn-secondary">Descargar PDF</button>
            </form>
        </div>

        <div class="mt-2">
            <a href="{{ route('report.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
@endsection
