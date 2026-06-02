@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="mb-4">Mon Fil D'actualité </h2>
            <div class="col-md-8">
                @if ($posts->isEmpty())
                    <div class="alert alert-info">
                        Aucun post à afficher. Abonnez-vous à des utilisateurs pour voir leurs posts.
                    </div>
                @else
                    @foreach ($posts as $post)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong>{{ $post->user->name }}</strong>
                                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="card-text mb-0">{{ $post->content }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
