@extends('layouts.app')

@section('title', 'Crear Actividad')

@section('content')
    <div class="container">
        <h1>Crear Actividad</h1>
        <form method="POST" action="{{ route('activity.store') }}">
            @csrf

            <div class="form-group">
                <label for="type_activity">Tipo de Actividad</label>
                <input type="text" class="form-control" id="type_activity" name="type_activity" required>
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="start_date">Fecha de Inicio</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>

            <div class="form-group">
                <label for="end_date">Fecha de Fin</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>

            <div class="form-group">
                <label for="worker_user_id">Trabajador</label>
                <select class="form-control" id="worker_user_id" name="worker_user_id" required>
                    @foreach ($trabajadores as $trabajador)
                        <option value="{{ $trabajador->id }}">{{ $trabajador->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="state_activity">Estado de la Actividad</label>
                <select class="form-control" id="state_activity" name="state_activity" required>
                    <option value="1">Pendiente</option>
                    <option value="0">Realizada</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Crear Actividad</button>
        </form>
    </div>
    @include('components.footer')
@endsection
