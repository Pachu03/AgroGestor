@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Usuarios al Grupo</h1>
    <form action="{{ route('group.save-user', $grupo->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_ids">Usuarios Trabajadores</label>
            <select name="user_ids[]" id="user_ids" class="form-control" multiple>
                @foreach ($trabajadores as $trabajador)
                    <option value="{{ $trabajador->id }}">{{ $trabajador->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Agregar Usuarios</button>
    </form>
</div>
@endsection
