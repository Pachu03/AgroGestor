@extends('layouts.app')

@section('title', __('Create Activities'))

@section('content')
    <div class="container">
        <h1>@lang('Create Activities')</h1>
        <form method="POST" action="{{ route('activity.store') }}">
            @csrf

            <div class="form-group">
                <label for="type_activity">@lang('Activity Type')</label>
                <input type="text" class="form-control" id="type_activity" name="type_activity" required>
            </div>

            <div class="form-group">
                <label for="description">@lang('Description')</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="start_date">@lang('Start Date')</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>

            <div class="form-group">
                <label for="end_date">@lang('End Date')</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>

            <div class="form-group">
                <label for="worker_user_id">@lang('Worker')</label>
                <select class="form-control" id="worker_user_id" name="worker_user_id" required>
                    @foreach ($trabajadores as $trabajador)
                        <option value="{{ $trabajador->id }}">{{ $trabajador->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="state_activity">@lang('Activity Status')</label>
                <select class="form-control" id="state_activity" name="state_activity" required>
                    <option value="1">@lang('Pending')</option>
                    <option value="0">@lang('Completed')</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Crear Actividad</button>
        </form>
    </div>
    @include('components.footer')
@endsection
