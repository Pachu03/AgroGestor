@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Generar Informe de Cosecha</h1>
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('report.generate') }}">
        @csrf

        <div class="form-group">
            <label for="harvest_id">Seleccione la Cosecha</label>
            <select class="form-control" id="harvest_id" name="harvest_id" required>
                @foreach($cosechas as $cosecha)
                    <option value="{{ $cosecha->id }}">
                        {{ $cosecha->date_collection }} - {{ $cosecha->product->name }} - {{ $cosecha->quantity_collection }} unidades
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Generar Informe</button>
    </form>
</div>
@endsection
