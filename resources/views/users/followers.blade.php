@extends('layouts.app')

{{-- Liste des personnes qui suivent l'utilisateur connecté --}}
@section('content')
    <h4 class="mb-4 fw-bold">Mes abonnés</h4>

    @if ($followers->isEmpty())
        <div class="alert alert-info">Vous n'avez aucun abonné pour le moment.</div>
    @else
        <div class="card shadow-sm">
            <ul class="list-group list-group-flush">
                @foreach ($followers as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('users.profile', $user->name) }}"
                           class="text-decoration-none text-reset fw-bold">
                            <i class="bi bi-person-circle"></i> {{ $user->name }}
                        </a>

                        {{-- Suivre en retour, ou se désabonner si on le suit déjà --}}
                        @if ($user->id !== auth()->id())
                            @if (auth()->user()->followings->contains($user->id))
                                <form action="{{ route('users.unfollow') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="following_id" value="{{ $user->id }}">
                                    <button class="btn btn-sm btn-outline-secondary">Se désabonner</button>
                                </form>
                            @else
                                <form action="{{ route('users.follow') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="following_id" value="{{ $user->id }}">
                                    <button class="btn btn-sm btn-primary">S'abonner</button>
                                </form>
                            @endif
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
