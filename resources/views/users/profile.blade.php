@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card mb-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3>{{ $profileUser->name }}</h3>
                            <small class="text-muted">Membre depuis {{ $profileUser->created_at->diffForHumans() }}</small>
                        </div>

                        @if ($profileUser->id !== auth()->id())
                            @if ($isFollowing)
                                <form action="{{ route('users.unfollow') }}" method="POST">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="following_id" value="{{ $profileUser->id }}">
                                    <button class="btn btn-sm btn-danger">Se désabonner</button>
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

                <h5>Posts de {{ $profileUser->name }}</h5>

                @forelse ($posts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <p>{{ $post->content }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>

                                @if ($post->user_id === auth()->id())
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button>Supprimer</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Aucun post pour l'instant.</p>
                @endforelse

            </div>
        </div>
    </div>
@endsection
