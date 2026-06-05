@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="mb-4">Mon Fil D'actualité</h2>
            <div class="col-md-8">
                @if ($posts->isEmpty())
                    <div class="alert alert-info">
                        Aucun post à afficher. Abonnez-vous à des utilisateurs pour voir leurs posts.
                    </div>
                @else
                    @foreach ($posts as $post)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong>{{ $post->user->name }}</strong>

                                            <form action="{{ route('users.unfollow') }}" method="POST">
                                                @csrf @method('DELETE')
                                                <input type="hidden" name="following_id" value="{{ $post->user_id }}">
                                                <button>Se désabonner</button>
                                            </form>

                                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="card-text mb-0">{{ $post->content }}</p>

                                @php $hasLiked = $post->likes->contains('user_id', auth()->id()); @endphp

                                <span>{{ $post->likes->count() }} like(s)</span>

                                @if ($hasLiked)
                                    <form action="{{ route('likes.destroy') }}" method="POST">
                                        @csrf @method('DELETE')
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <button type="submit">Retirer</button>
                                    </form>
                                @else
                                    <form action="{{ route('likes.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <button type="submit">Liker</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
