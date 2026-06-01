@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="mb-4">Mes abonnements</h2>
        @if ($followings->isEmpty())
            <p class="text-muted">Vous n'êtes abonné à personne pour le moment.</p>
        @else
            <table class="table table-bordered">
                <tbody>
                @foreach ($followings as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>
                            <form action="{{ route('users.unfollow') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="following_id" value="{{ $user->id }}">
                                <button class="btn btn-sm btn-danger">Désabonner</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
