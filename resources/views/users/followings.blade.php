@extends('layouts.app')

{{-- Liste des comptes suivis par l'utilisateur connecté --}}
@section('content')
    <h4 class="mb-4 fw-bold">Mes abonnements</h4>

    @if ($followings->isEmpty())
        <div class="alert alert-info">Vous n'êtes abonné à personne pour le moment.</div>
    @else
        <div class="card shadow-sm">
            <ul class="list-group list-group-flush">
                @foreach ($followings as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('users.profile', $user->name) }}"
                           class="text-decoration-none text-reset fw-bold">
                            <i class="bi bi-person-circle"></i> {{ $user->name }}
                        </a>
                        <form action="{{ route('users.unfollow') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="following_id" value="{{ $user->id }}">
                            <button class="btn btn-sm btn-outline-secondary">Se désabonner</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
