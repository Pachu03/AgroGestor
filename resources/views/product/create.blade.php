@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Agregar Producto</h1>
        <form method="POST" action="{{ route('product.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nombre del Producto</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Producto</button>
        </form>
    </div>
@endsection
