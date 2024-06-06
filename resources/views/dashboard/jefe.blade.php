@extends('layouts.app')

@section('title', 'Panel de Control')

@section('content')
    <div class="container">
        <h1>@lang('Wellcome') {{ Auth::user()->name }}</h1>

        @if ($actividades->isEmpty())
            <p>@lang("You haven't assigned any activities yet")</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>@lang(('Activity Type'))</th>
                        <th>@lang(('Description'))</th>
                        <th>@lang(('Start Date'))</th>
                        <th>@lang(('End Date'))</th>
                        <th>@lang(('Status'))</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($actividades as $actividad)
                        <tr>
                            <td>{{ $actividad->type_activity }}</td>
                            <td>{{ $actividad->description }}</td>
                            <td>{{ $actividad->start_date }}</td>
                            <td>{{ $actividad->end_date }}</td>
                            <td>{{ $actividad->state_activity ? 'Pendiente' : 'Realizada' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        {{ $actividades->links('vendor.pagination.bootstrap-4') }}

    </div>
    @include('components.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
