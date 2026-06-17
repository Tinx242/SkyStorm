@extends('layouts.app')

{{-- Profil public d'un utilisateur : ses infos, ses abonnés/abonnements et ses posts --}}
@section('content')
    {{-- En-tête du profil : nom, date d'inscription, compteurs et bouton suivre --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-person-circle"></i> {{ $profileUser->name }}
                </h4>
                <small class="text-muted">Inscrit {{ $profileUser->created_at->diffForHumans() }}</small>

                <div class="mt-2">
                    <span class="badge bg-secondary me-2">
                        {{ $profileUser->followers->count() }} abonné(s)
                    </span>
                    <span class="badge bg-secondary">
                        {{ $profileUser->followings->count() }} abonnement(s)
                    </span>
                </div>
            </div>

            {{-- Bouton suivre / se désabonner, masqué sur son propre profil --}}
            @if ($profileUser->id !== auth()->id())
                @if ($isFollowing)
                    <form action="{{ route('users.unfollow') }}" method="POST">
                        @csrf @method('DELETE')
                        <input type="hidden" name="following_id" value="{{ $profileUser->id }}">
                        <button class="btn btn-sm btn-outline-secondary">Se désabonner</button>
                    </form>
                @else
                    <form action="{{ route('users.follow') }}" method="POST">
                        @csrf
                        <input type="hidden" name="following_id" value="{{ $profileUser->id }}">
                        <button class="btn btn-sm btn-primary">S'abonner</button>
                    </form>
                @endif
            @endif
        </div>
    </div>

    {{-- Liste des abonnés de ce profil --}}
    <div class="card mb-3 shadow-sm">
        <div class="card-header fw-bold">
            <i class="bi bi-people"></i> Abonnés ({{ $profileUser->followers->count() }})
        </div>
        <ul class="list-group list-group-flush" style="max-height: 280px; overflow-y: auto;">
            @forelse ($profileUser->followers as $follower)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('users.profile', $follower->name) }}"
                       class="d-flex align-items-center gap-2 text-decoration-none text-reset">
                        <i class="bi bi-person-circle fs-4 text-secondary"></i>
                        <span class="fw-semibold">{{ $follower->name }}</span>
                    </a>

                    @if ($follower->id !== auth()->id())
                        @if (auth()->user()->followings->contains($follower->id))
                            <form action="{{ route('users.unfollow') }}" method="POST">
                                @csrf @method('DELETE')
                                <input type="hidden" name="following_id" value="{{ $follower->id }}">
                                <button class="btn btn-sm btn-outline-secondary">Se désabonner</button>
                            </form>
                        @else
                            <form action="{{ route('users.follow') }}" method="POST">
                                @csrf
                                <input type="hidden" name="following_id" value="{{ $follower->id }}">
                                <button class="btn btn-sm btn-primary">S'abonner</button>
                            </form>
                        @endif
                    @endif
                </li>
            @empty
                <li class="list-group-item text-muted text-center py-4">
                    <i class="bi bi-people fs-3 d-block mb-1"></i>
                    Aucun abonné pour le moment.
                </li>
            @endforelse
        </ul>
    </div>

    {{-- Liste des abonnements de ce profil --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header fw-bold">
            <i class="bi bi-person-check"></i> Abonnements ({{ $profileUser->followings->count() }})
        </div>
        <ul class="list-group list-group-flush" style="max-height: 280px; overflow-y: auto;">
            @forelse ($profileUser->followings as $following)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('users.profile', $following->name) }}"
                       class="d-flex align-items-center gap-2 text-decoration-none text-reset">
                        <i class="bi bi-person-circle fs-4 text-secondary"></i>
                        <span class="fw-semibold">{{ $following->name }}</span>
                    </a>

                    @if ($following->id !== auth()->id())
                        @if (auth()->user()->followings->contains($following->id))
                            <form action="{{ route('users.unfollow') }}" method="POST">
                                @csrf @method('DELETE')
                                <input type="hidden" name="following_id" value="{{ $following->id }}">
                                <button class="btn btn-sm btn-outline-secondary">Se désabonner</button>
                            </form>
                        @else
                            <form action="{{ route('users.follow') }}" method="POST">
                                @csrf
                                <input type="hidden" name="following_id" value="{{ $following->id }}">
                                <button class="btn btn-sm btn-primary">S'abonner</button>
                            </form>
                        @endif
                    @endif
                </li>
            @empty
                <li class="list-group-item text-muted text-center py-4">
                    <i class="bi bi-person-check fs-3 d-block mb-1"></i>
                    Aucun abonnement pour le moment.
                </li>
            @endforelse
        </ul>

        <div class="card-footer text-center">
            <a href="{{ route('users.followings') }}" class="text-decoration-none" style="color: #1d9bf0; font-weight: 600;">
                Voir plus <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    {{-- Posts publiés par ce profil --}}
    <h5 class="fw-bold mb-3">Posts de {{ $profileUser->name }}</h5>

    @forelse ($posts as $post)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <p class="card-text mb-2">{{ $post->content }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>

                    {{-- Suppression réservée à l'auteur du post --}}
                    @if ($post->user_id === auth()->id())
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">Aucun post pour l'instant.</p>
    @endforelse
@endsection
