@extends('layouts.app')

{{-- Liste des notes de l'utilisateur connecté --}}
@section('content')
    <h4 class="mb-4 fw-bold">Mes notes</h4>

    @forelse ($notes as $note)
        <div class="card mb-3 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold"><i class="bi bi-journal-text"></i> Note</span>
                <small class="text-muted">{{ $note->created_at->diffForHumans() }}</small>
            </div>
            <div class="card-body">
                <p class="card-text mb-3">{{ $note->content }}</p>

                {{-- Actions : publier la note en post, ou la supprimer --}}
                <div class="d-flex gap-2">
                    <form action="{{ route('notes.toPost', $note) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="bi bi-send"></i> Transformer en post
                        </button>
                    </form>

                    <form action="{{ route('notes.destroy', $note) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="alert alert-info">Aucune note pour l'instant.</p>
    @endforelse
@endsection
