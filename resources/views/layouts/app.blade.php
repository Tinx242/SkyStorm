<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SkyStorm') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/oiseau2.svg') }}">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">

    {{-- NAVBAR : fixe en haut, contient logo + onglets + login --}}
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">

            {{-- Logo : ramène au feed si connecté, sinon à l'accueil public --}}
            <a class="navbar-brand" href="{{ auth()->check() ? route('posts.home') : url('/') }}">
                <img src="{{ asset('images/SkyStorm.svg') }}" alt="SkyStorm" height="35">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                {{-- Onglets centrés (Pour vous / Abonnements) --}}
                @auth
                    <ul class="navbar-nav nav-tabs-x">
                        <li class="nav-item">
                            <a class="nav-link-x {{ request()->routeIs('posts.home') ? 'active' : '' }}"
                               href="{{ route('posts.home') }}">Acceuil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-x {{ request()->routeIs('posts.feed') ? 'active' : '' }}"
                               href="{{ route('posts.feed') }}">Mon Feed</a>
                        </li>
                    </ul>
                @endauth

                {{-- Login/Register uniquement pour les visiteurs non connectés --}}
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @endguest
                </ul>

            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <div class="row">

                {{-- SIDEBAR GAUCHE : visible uniquement si connecté --}}
                @auth
                    <div class="col-md-3">
                        <div class="sidebar">

                            {{-- Formulaire créer un post --}}
                            <div class="card shadow-sm mb-3">
                                <div class="card-header fw-bold">
                                    <i class="bi bi-pen"></i> Nouveau post
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('posts.store') }}" method="POST">
                                        @csrf
                                        <textarea name="content" class="form-control mb-2" rows="4" placeholder="Quoi de neuf ?" style="resize: none;"></textarea>
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-send"></i> Publier
                                        </button>
                                    </form>
                                </div>
                            </div>

                            {{-- Formulaire créer une note --}}
                            <div class="card shadow-sm mb-3">
                                <div class="card-header fw-bold">
                                    <i class="bi bi-journal-text"></i> Nouvelle note
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('notes.store') }}" method="POST">
                                        @csrf
                                        <textarea name="content" class="form-control mb-2" rows="4" placeholder="Écrivez une note..." style="resize: none;"></textarea>
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-save"></i> Enregistrer
                                        </button>
                                    </form>
                                </div>
                            </div>

                            {{-- Liens de navigation --}}
                            <ul class="nav flex-column sidebar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('posts.index') }}">
                                        <i class="bi bi-mailbox"></i> Mes posts
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('notes.index') }}">
                                        <i class="bi bi-journal-text"></i> Mes notes
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.followings') }}">
                                        <i class="bi bi-person-check"></i> Abonnements
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.followers') }}">
                                        <i class="bi bi-people-fill"></i> Abonnés
                                    </a>
                                </li>
                            </ul>

                            {{-- Profil + logout poussés en bas par margin-top: auto --}}
                            <div class="sidebar-bottom">
                                <hr>
                                <div class="sidebar-profile">
                                    <div class="profile-info">
                                        <a class="nav-link" href="{{ route('users.profile', Auth::user()->name) }}">
                                            <i class="bi bi-person-circle fs-4" ></i>
                                            <span>{{ Auth::user()->name }}</span>
                                        </a>
                                    </div>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary" title="Logout">
                                            <i class="bi bi-box-arrow-right"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                @endauth

                {{-- CONTENU PRINCIPAL : 6 colonnes si connecté, 12 sinon --}}
                <div class="{{ auth()->check() ? 'col-md-6' : 'col-md-12' }}">
                    @yield('content')
                </div>

                {{-- SIDEBAR DROITE : suggestions de comptes à suivre --}}
                @auth
                    <div class="col-md-3">
                        <div class="sidebar">
                            <div class="card shadow-sm">
                                <div class="card-header fw-bold">
                                    <i class="bi bi-people"></i> Suggestions
                                </div>
                                <ul class="list-group list-group-flush">
                                    @php $count = 0; @endphp
                                    @foreach (App\Models\User::all() as $user)
                                        {{-- Saute son propre profil --}}
                                        @continue($user->id === auth()->id())
                                        {{-- Saute les gens déjà suivis --}}
                                        @continue(auth()->user()->followings->contains($user->id))
                                        {{-- Limite à 5 suggestions --}}
                                        @break($count === 5)

                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ route('users.profile', $user->name) }}"
                                               class="suggestion-link text-decoration-none text-reset">
                                                <i class="bi bi-person-circle"></i> {{ $user->name }}
                                            </a>
                                            <form action="{{ route('users.follow') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="following_id" value="{{ $user->id }}">
                                                <button class="btn btn-sm btn-primary">S'abonner</button>
                                            </form>
                                        </li>

                                        @php $count++; @endphp
                                    @endforeach
                                </ul>

                                {{-- Lien vers la page complète --}}
                                <div class="card-footer text-center">
                                    <a href="{{ route('users.index') }}" class="text-decoration-none" style="color: #1d9bf0; font-weight: 600;">
                                        Voir plus <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endauth

            </div>
        </div>
    </main>
</div>
</body>
</html>
