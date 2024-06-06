@extends('layouts.app')

@section('title', __('Register Harvest'))

@section('content')
    <div class="container">
        <h1>@lang('Register Harvest')</h1>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if ($gruposValidos->isNotEmpty())
            <form method="POST" action="{{ route('harvest.store') }}">
                @csrf

                <div class="form-group">
                    <label for="date_collection">@lang('Harvest Date')</label>
                    <input type="date" class="form-control" id="date_collection" name="date_collection" required>
                </div>

                <div class="form-group">
                    <label for="quantity_collection">@lang('Collected Quantity')</label>
                    <input type="number" class="form-control" id="quantity_collection" name="quantity_collection"
                        min="1" max="10000" required>
                </div>

                <div class="form-group">
                    <label for="product_id">@lang('Product')</label>
                    <select class="form-control" id="product_id" name="product_id" required>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="group_id">@lang('Group')</label>
                    <select class="form-control" id="group_id" name="group_id" required>
                        @foreach ($gruposValidos as $grupo)
                            <option value="{{ $grupo->id }}">{{ $grupo->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">@lang('Register Harvest')</button>
            </form>
        @else
            <div class="alert alert-danger mt-3">
                @lang('There are no groups available to select, create a group, or add Workers to the groups').<br>
                @lang('If you encounter any problems, contact the System Administrator').
            </div>
        @endif
    </div>
    @include('components.footer')
@endsection
