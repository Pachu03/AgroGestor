@extends('layouts.app')

@section('title', 'Lista de Lluvias')

@section('content')
    <div class="container">
        <h1>Lista de Lluvias</h1>

        <!-- Mensajes de éxito y error -->
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Filtros -->
        <form method="GET" action="{{ route('rains.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="from_date">Desde</label>
                        <input type="date" id="from_date" name="from_date" class="form-control"
                            value="{{ request('from_date') }}">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="to_date">Hasta</label>
                        <input type="date" id="to_date" name="to_date" class="form-control"
                            value="{{ request('to_date') }}">
                    </div>
                </div>
                <div class="col-md-2 align-self-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Milímetros</th>
                    <th>Localidad</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rains as $rain)
                    <tr>
                        <td>{{ $rain->date }}</td>
                        <td>{{ $rain->quanti_MM }}</td>
                        <td>{{ $rain->localiti }}</td>
                        <td>{{ $rain->user->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('components.footer')
@endsection
