@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Grupos</h1>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <ul class="list-group mt-3">
            @foreach ($grupos->slice(3) as $grupo)
                <li class="list-group-item">
                    <strong>{{ $grupo->name }}</strong>
                    <span class="badge badge-primary badge-pill">{{ $grupo->users->count() }} Usuarios</span>
                    <a href="{{ route('group.add-user', $grupo->id) }}" class="btn btn-sm btn-success float-right">Agregar
                        Usuarios</a>
                    <ul class="list-group mt-2">
                        @foreach ($grupo->users as $user)
                            <li class="list-group-item">{{ $user->name }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
    @include('components.footer')
@endsection
