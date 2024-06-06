@extends('layouts.app')

@section('title', __('Historial de Actividades'))

@section('content')
    <div class="container">
        <h1>@lang('Activity History')</h1>
        <ul class="list-group mt-3">
            @forelse ($history as $activity)
                <li class="list-group-item {{ $activity->isDelayed() ? 'text-danger' : '' }}">
                    <strong>{{ $activity->type_activity }}</strong> - {{ $activity->description }}<br>
                    <strong>@lang('Start Date'):</strong> {{ $activity->start_date }}<br>
                    <strong>@lang('End Date'):</strong> {{ $activity->end_date }}<br>
                    <strong>@lang('Boss'):</strong> {{ $activity->boss_user_id }}<br>
                </li>
            @empty
                <li class="list-group-item">
                    @lang('There is no activity history available').
                </li>
            @endforelse
        </ul>
    </div>
    @include('components.footer')
@endsection
