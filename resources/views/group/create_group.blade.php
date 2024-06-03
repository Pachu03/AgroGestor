@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Grupo</h1>
        <form action="{{ route('group.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre del Grupo</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Crear Grupo</button>
        </form>
    </div>
    @include('components.footer')
@endsection
