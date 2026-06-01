@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="mb-4">Mes Posts</h2>
            <div class="col-md-8">
                @foreach ($posts as $post)
                    <div class="card mb-3">
                        <div class="card-header">{{ __('Mes Posts') }}</div>

                        <div class="card-body">
                            {{ $post->content }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
