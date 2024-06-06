@extends('layouts.app')

@section('title', __('Create Group'))

@section('content')
    <div class="container">
        <h1>@lang('Create Group')</h1>
        <form action="{{ route('group.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">@lang('Name Group')</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">@lang('Description')</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">@lang('Create Group')</button>
        </form>
    </div>
    @include('components.footer')
@endsection
