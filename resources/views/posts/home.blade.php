@extends('layouts.app')

@section('content')
    <h4 class="mb-4 fw-bold">Accueil</h4>

    @foreach ($posts as $post)
        {{-- État du post pour l'utilisateur courant : liké, abonné à l'auteur, post personnel --}}
        @php
            $hasLiked    = $post->likes->contains('user_id', auth()->id());
            $isFollowing = auth()->user()->followings->contains($post->user_id);
            $isOwnPost   = $post->user_id === auth()->id();
        @endphp

        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('users.profile', $post->user->name) }}"
                           class="text-decoration-none text-reset fw-bold">
                            <i class="bi bi-person-circle"></i> {{ $post->user->name }}
                        </a>

                        {{-- Bouton suivre / se désabonner, masqué sur ses propres posts --}}
                        @if (!$isOwnPost)
                            @if ($isFollowing)
                                <form action="{{ route('users.unfollow') }}" method="POST">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="following_id" value="{{ $post->user_id }}">
                                    <button class="btn btn-sm btn-outline-secondary">Se désabonner</button>
                                </form>
                            @else
                                <form action="{{ route('users.follow') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="following_id" value="{{ $post->user_id }}">
                                    <button class="btn btn-sm btn-primary">S'abonner</button>
                                </form>
                            @endif
                        @endif
                    </div>
                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                </div>

                <p class="card-text mb-2">{{ $post->content }}</p>

                {{-- Bouton like : cœur plein pour retirer le like, cœur vide pour liker --}}
                <div class="d-flex align-items-center gap-2">
                    @if ($hasLiked)
                        <form action="{{ route('likes.destroy') }}" method="POST">
                            @csrf @method('DELETE')
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <button type="submit" class="btn btn-sm btn-link text-danger p-0 text-decoration-none">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('likes.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <button type="submit" class="btn btn-sm btn-link text-secondary p-0 text-decoration-none">
                                <i class="bi bi-heart"></i>
                            </button>
                        </form>
                    @endif
                    <small class="text-muted">{{ $post->likes->count() }} j'aime</small>
                </div>
            </div>
        </div>
    @endforeach
@endsection
