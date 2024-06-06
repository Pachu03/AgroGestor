@extends('layouts.app')

@section('title', __('Edit User'))

@section('content')
    <div class="container">
        <h1>@lang('Edit User')</h1>

        <!-- Mensajes de error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">@lang('Name')</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">@lang('Email')</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">@lang('Password')</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">@lang('Role')</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="jefe">@lang('Boss')</option>
                    <option value="trabajador">@lang('Worker')</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">@lang('Update')</button>
        </form>
    </div>
    @include('components.footer')

@endsection
