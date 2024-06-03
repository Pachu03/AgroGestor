@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Historial de Actividades</h1>
        <ul class="list-group mt-3">
            @forelse ($history as $activity)
                <li class="list-group-item {{ $activity->isDelayed() ? 'text-danger' : '' }}">
                    <strong>{{ $activity->type_activity }}</strong> - {{ $activity->description }}<br>
                    <strong>Fecha de Inicio:</strong> {{ $activity->start_date }}<br>
                    <strong>Fecha de Fin:</strong> {{ $activity->end_date }}<br>
                    <strong>Jefe:</strong> {{ $activity->boss_user_id }}<br>
                </li>
            @empty
                <li class="list-group-item">
                    No hay historial de actividades disponible.
                </li>
            @endforelse
        </ul>
    </div>
    @include('components.footer')
@endsection
