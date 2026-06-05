@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="mb-4">Accueil</h2>
            <div class="col-md-8">
                @foreach ($posts as $post)
                    @php
                        $hasLiked     = $post->likes->contains('user_id', auth()->id());
                        $isFollowing  = auth()->user()->followings->contains($post->user_id);
                        $isOwnPost    = $post->user_id === auth()->id();
                    @endphp

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <strong>{{ $post->user->name }}</strong>

                                     @if (!$isOwnPost)
                                        @if ($isFollowing)
                                            <form action="{{ route('users.unfollow') }}" method="POST">
                                                @csrf @method('DELETE')
                                                <input type="hidden" name="following_id" value="{{ $post->user_id }}">
                                                <button>Se désabonner</button>
                                            </form>
                                        @else
                                            <form action="{{ route('users.follow') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="following_id" value="{{ $post->user_id }}">
                                                <button>S'abonner</button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            </div>

                            <p class="card-text mb-2">{{ $post->content }}</p>

                            <div class="d-flex align-items-center gap-2">
                                <span>{{ $post->likes->count() }}</span>

                                @if ($hasLiked)
                                    <form action="{{ route('likes.destroy') }}" method="POST">
                                        @csrf @method('DELETE')
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <button>Retirer</button>
                                    </form>
                                @else
                                    <form action="{{ route('likes.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <button>Liker</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
