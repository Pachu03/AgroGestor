@extends('layouts.app')

@section('title', 'Panel de Control')

@section('content')
    <div class="container">
        <h1>@lang('Wellcome') {{ Auth::user()->name }}</h1>

        <h2>@lang('Pending Activities')</h2>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if ($activities->isEmpty())
            <div class="alert alert-info mt-3">
                @lang('There are no pending activities available')
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($activities as $activity)
                    <li class="list-group-item {{ $activity->isDelayed() ? 'text-danger' : '' }}">
                        <strong>{{ $activity->type_activity }}</strong> - {{ $activity->description }}<br>
                        <strong>@lang('Start Date'):</strong> {{ $activity->start_date }}<br>
                        <strong>@lang('End Date'):</strong> {{ $activity->end_date }}<br>
                        <strong>@lang('Boss'):</strong> {{ $activity->boss_user_id }}<br>
                        <form method="POST" action="{{ route('task.finish') }}">
                            @csrf
                            <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                            <button type="submit" class="btn btn-sm btn-success">Finalizar</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
        <!-- Paginación -->
        {{ $activities->links('vendor.pagination.bootstrap-4') }}
    </div>
    @include('components.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
