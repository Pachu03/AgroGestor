@extends('layouts.app')

@section('title', __('Add Users to Group'))

@section('content')
    <div class="container">
        <h1>@lang('Add Users to Group')</h1>
        <form action="{{ route('group.save-user', $grupo->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_ids">@lang('Worker Users')</label>
                <select name="user_ids[]" id="user_ids" class="form-control" multiple>
                    @foreach ($trabajadores as $trabajador)
                        <option value="{{ $trabajador->id }}">{{ $trabajador->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">@lang('Add Users')</button>
        </form>
    </div>
    @include('components.footer')
@endsection
