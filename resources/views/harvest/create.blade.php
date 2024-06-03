@extends('layouts.app')

@section('title', 'Registrar Cosecha')

@section('content')
    <div class="container">
        <h1>Registrar Cosecha</h1>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('harvest.store') }}">
            @csrf

            <div class="form-group">
                <label for="date_collection">Fecha de Recolección</label>
                <input type="date" class="form-control" id="date_collection" name="date_collection" required>
            </div>

            <div class="form-group">
                <label for="quantity_collection">Cantidad Recogida</label>
                <input type="number" class="form-control" id="quantity_collection" name="quantity_collection"
                    min="1" max="10000" required>
            </div>

            <div class="form-group">
                <label for="product_id">Producto</label>
                <select class="form-control" id="product_id" name="product_id" required>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="group_id">Grupo</label>
                <select class="form-control" id="group_id" name="group_id" required>
                    @foreach ($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Cosecha</button>
        </form>
    </div>
    @include('components.footer')
@endsection
