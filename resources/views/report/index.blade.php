@extends('layouts.app')

@section('title', __('Generate Harvest Report'))

@section('content')
    <div class="container">
        <h1>@lang('Generate Harvest Report')</h1>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if ($cosechas->isEmpty())
            <div class="alert alert-warning mt-3">
                @lang('There are no harvests available to generate a report').
            </div>
        @else
            <form method="POST" action="{{ route('report.generate') }}">
                @csrf

                <div class="form-group">
                    <label for="harvest_id">@lang('Select the Harvest')</label>
                    <select class="form-control" id="harvest_id" name="harvest_id" required>
                        @foreach ($cosechas as $cosecha)
                            <option value="{{ $cosecha->id }}">
                                {{ $cosecha->date_collection }} - {{ $cosecha->product->name }} -
                                {{ $cosecha->quantity_collection }} @lang('kilos')
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" name="action" value="view" class="btn btn-primary">@lang('View Report')</button>
                </div>
            </form>
        @endif
    </div>
    @include('components.footer')
@endsection
