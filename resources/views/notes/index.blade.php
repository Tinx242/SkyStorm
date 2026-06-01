@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="mb-4">Mes Notes</h2>
            <div class="col-md-8">
                @foreach ($notes as $note)
                <div class="card">
                    <div class="card-header">{{ __('Mes Notes') }}</div>

                    <div class="card-body">
                        {{ $note -> content}}
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
