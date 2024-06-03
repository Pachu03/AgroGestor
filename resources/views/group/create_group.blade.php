@extends('layouts.app')

@section('title', 'Crear Grupo')

@section('content')
    <div class="container">
        <h1>Crear Grupo</h1>
        <form action="{{ route('group.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre del Grupo</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Crear Grupo</button>
        </form>
    </div>
    @include('components.footer')
@endsection
