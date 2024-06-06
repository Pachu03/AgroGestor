@extends('layouts.app')

@section('title', __('Harvest Report'))

@section('content')
    <div class="container">
        <h1>@lang('Harvest Report')</h1>
        <table class="table">
            <tr>
                <th>@lang('Harvest Date')</th>
                <td>{{ $collection->date_collection }}</td>
            </tr>
            <tr>
                <th>@lang('Collected Quantity')</th>
                <td>{{ $collection->quantity_collection }}</td>
            </tr>
            <tr>
                <th>@lang('Product')</th>
                <td>{{ $collection->product->name }}</td>
            </tr>
            <tr>
                <th>@lang('Group and Members')</th>
                <td>
                    {{ $collection->group->name }}<br>
                    @foreach ($collection->group->users as $user)
                        {{ $user->name }}<br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>@lang('Boss')</th>
                <td>{{ $collection->user->name }}</td>
            </tr>
        </table>

        <div class="mt-4">
            <form method="POST" action="{{ route('report.generate') }}">
                @csrf
                <input type="hidden" name="harvest_id" value="{{ $collection->id }}">
                <button type="submit" name="action" value="download" class="btn btn-secondary">@lang('Download PDF')</button>
            </form>
        </div>

        <div class="mt-2">
            <a href="{{ route('report.index') }}" class="btn btn-primary">@lang('Back')</a>
        </div>
    </div>
    @include('components.footer')
@endsection
