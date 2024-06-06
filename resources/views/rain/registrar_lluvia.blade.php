@extends('layouts.app')

@section('title', __('Register Rain'))

@section('content')
    <div class="container">
        <h1>@lang('Register Rain')</h1>

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

        <form method="POST" action="{{ route('rains.store') }}">
            @csrf

            <div class="form-group">
                <label for="date">@lang('Date')</label>
                <input type="date" id="date" name="date" class="form-control" min="{{ $minDate }}"
                    value="{{ old('date') }}" required>
            </div>

            <div class="form-group">
                <label for="quanti_MM">@lang('Square Millimeters')</label>
                <input type="number" id="quanti_MM" name="quanti_MM" class="form-control" min="0" max="1000"
                    value="{{ old('quanti_MM') }}" required>
            </div>

            <div class="form-group">
                <label for="localiti">@lang('location')</label>
                <input type="text" id="localiti" name="localiti" class="form-control" value="{{ old('localiti') }}"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">@lang('Register Rain')</button>
        </form>
    </div>
    @include('components.footer')
@endsection
