@extends('layouts.app')

{{-- Liste des posts de l'utilisateur connecté, avec possibilité de les supprimer --}}
@section('content')
    <h4 class="mb-4 fw-bold">Mes posts</h4>

    @forelse ($posts as $post)
        <div class="card mb-3 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold"><i class="bi bi-person-circle"></i> {{ auth()->user()->name }}</span>
                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
            </div>
            <div class="card-body">
                <p class="card-text mb-0">{{ $post->content }}</p>
            </div>
            <div class="card-footer text-end">
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p class="alert alert-info">Aucun post pour l'instant.</p>
    @endforelse
@endsection
