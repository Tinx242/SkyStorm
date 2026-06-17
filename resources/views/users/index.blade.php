@extends('layouts.app')

{{-- Liste de tous les utilisateurs à suivre (suggestions) --}}
@section('content')
    <h4 class="mb-4 fw-bold">Mes suggestions</h4>

    <div class="card shadow-sm">
        <ul class="list-group list-group-flush">
            @foreach ($users as $user)
                @continue($user->id === auth()->id())
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('users.profile', $user->name) }}"
                       class="text-decoration-none text-reset fw-bold">
                        <i class="bi bi-person-circle"></i> {{ $user->name }}
                    </a>

                    {{-- Bouton suivre / se désabonner selon qu'on suit déjà l'utilisateur --}}
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
                </li>
            @endforeach
        </ul>
    </div>
@endsection
