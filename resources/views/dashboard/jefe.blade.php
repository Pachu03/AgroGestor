@extends('layouts.app')

@section('title', 'Panel de Control')

@section('content')
    <div class="container">
        <h1>Bienvenido</h1>
        
        @include('admin.listUser')

    </div>
    @include('components.footer')
@endsection
