@extends('layouts.app')

@section('title', 'Actividades como Jefe')

@section('content')
    <div class="container">
        <h1>Actividades como Jefe</h1>

        @if ($actividades->isEmpty())
            <p>No hay actividades asignadas.</p>
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
    </div>
    @include('components.footer')
@endsection
