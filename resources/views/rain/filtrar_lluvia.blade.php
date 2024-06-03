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

        <!-- Verificar si hay datos en la tabla de lluvias -->
        @if ($rains->isEmpty())
            <div class="alert alert-info mt-3">
                No hay registros de lluvias.
            </div>
        @else
            <!-- Filtros -->
            <form id="filterForm" method="GET" action="{{ route('rains.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="from_date">Desde</label>
                            <input type="date" id="from_date" name="from_date" class="form-control"
                                value="{{ request('from_date') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="to_date">Hasta</label>
                            <input type="date" id="to_date" name="to_date" class="form-control"
                                value="{{ request('to_date') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="locality">Localidad</label>
                            <select id="locality" name="locality" class="form-control">
                                <option value="">Todas las localidades</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                        <button type="button" id="resetFilters" class="btn btn-secondary ml-2">Restablecer filtros</button>
                    </div>
                </div>
            </form>

            <!-- Tabla de lluvias -->
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

            <!-- Paginación -->
            {{ $rains->links('vendor.pagination.bootstrap-4') }}
        @endif
    </div>
    @include('components.footer')

    <!-- Incluir el archivo JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/filtersRain.js') }}"></script>
@endsection
