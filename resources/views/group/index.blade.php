@extends('layouts.app')

@section('title', 'Lista de Grupo')

@section('content')
    <div class="container">
        <h1>Lista de Grupos</h1>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @php
            $grupoCount = $grupos->count();
        @endphp

        @if ($grupoCount > 3)
            <ul class="list-group mt-3">
                @foreach ($grupos->slice(3) as $grupo)
                    <li class="list-group-item">
                        <strong>{{ $grupo->name }}</strong>
                        <span class="badge badge-primary badge-pill">{{ $grupo->users->count() }} Usuarios</span>
                        <a href="{{ route('group.add-user', $grupo->id) }}" class="btn btn-sm btn-success float-right">Agregar
                            Usuarios</a>
                        <a href="{{ route('group.destroy', $grupo->id) }}" class="btn btn-sm btn-danger float-right">Eliminar
                            grupo</a>
                        <ul class="list-group mt-2">
                            @foreach ($grupo->users as $user)
                                <li class="list-group-item">{{ $user->name }}</li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-info mt-3">
                No hay ningún grupo creado. Para crear un grupo, selecciona la opción de <a
                    href="{{ route('group.create') }}">Crear Grupo</a>.
            </div>
        @endif
    </div>
    @include('components.footer')
@endsection
