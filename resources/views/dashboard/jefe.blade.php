@extends('layouts.app')

@section('title', 'Panel de Control')

@section('content')
    <div class="container">
        <h1>Bienvenido {{ Auth::user()->name }}</h1>

        @if ($actividades->isEmpty())
            <p>No has asignado aun actividades.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Tipo de Actividad</th>
                        <th>Descripción</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($actividades as $actividad)
                        <tr>
                            <td>{{ $actividad->type_activity }}</td>
                            <td>{{ $actividad->description }}</td>
                            <td>{{ $actividad->start_date }}</td>
                            <td>{{ $actividad->end_date }}</td>
                            <td>{{ $actividad->state_activity ? 'Pendiente' : 'Realizada' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        
    {{ $actividades->links('vendor.pagination.bootstrap-4') }}

    </div>
    @include('components.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
