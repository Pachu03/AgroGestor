@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Actividades Pendientes</h1>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if ($activities->isEmpty())
            <div class="alert alert-info mt-3">
                No hay actividades pendientes disponibles.
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($activities as $activity)
                    <li class="list-group-item {{ $activity->isDelayed() ? 'text-danger' : '' }}">
                        <strong>{{ $activity->type_activity }}</strong> - {{ $activity->description }}<br>
                        <strong>Fecha de Inicio:</strong> {{ $activity->start_date }}<br>
                        <strong>Fecha de Fin:</strong> {{ $activity->end_date }}<br>
                        <strong>Jefe:</strong> {{ $activity->boss_user_id }}<br>
                        <form method="POST" action="{{ route('task.finish') }}">
                            @csrf
                            <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                            <button type="submit" class="btn btn-sm btn-success">Finalizar</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    @include('components.footer')
@endsection
