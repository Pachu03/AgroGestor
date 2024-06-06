@extends('layouts.app')

@section('title', __('Add Product'))

@section('content')
    <div class="container">
        <h1>@lang('Add Product')</h1>
        <form method="POST" action="{{ route('product.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">@lang('Product Name')</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">@lang('Description')</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">@lang('Register Product')</button>
        </form>
    </div>
    @include('components.footer')
@endsection
