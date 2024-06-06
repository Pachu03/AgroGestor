@extends('layouts.app')

@section('title', __('Group List'))

@section('content')
    <div class="container">
        <h1>@Lang('Group List')</h1>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @php
            $grupoCount = $grupos->count();
        @endphp

        @if ($grupoCount > 3)
            <ul class="list-group mt-3">
                @foreach ($grupos->slice(3) as $grupo)
                    <li class="list-group-item">
                        <strong>{{ $grupo->name }}</strong>
                        <span class="badge badge-primary badge-pill">{{ $grupo->users->count() }} @lang('Users')</span>
                        <a href="{{ route('group.add-user', $grupo->id) }}"
                            class="btn btn-sm btn-success float-right">@lang('Add Users')</a>
                        <a href="{{ route('group.destroy', $grupo->id) }}"
                            class="btn btn-sm btn-danger float-right">@lang('Delete group')</a>
                        <ul class="list-group mt-2">
                            @foreach ($grupo->users as $user)
                                <li class="list-group-item">{{ $user->name }}</li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-info mt-3">
                @lang('There are no groups created. To create a group, select the option to') <a href="{{ route('group.create') }}">@lang('Create Group')</a>.
            </div>
        @endif
    </div>
    @include('components.footer')
@endsection
