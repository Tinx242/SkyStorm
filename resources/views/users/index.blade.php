@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-4">Mes Suggestions</h2>
                <table>
                    @foreach ($users as $user)
                        @continue($user->id === auth()->id())
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>
                                @if (auth()->user()->followings->contains($user->id))
                                    <form action="{{ route('users.unfollow') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="following_id" value="{{ $user->id }}">
                                        <button class="btn btn-sm btn-danger">Désabonner</button>
                                    </form>
                                @else
                                    <form action="{{ route('users.follow') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="following_id" value="{{ $user->id }}">
                                        <button class="btn btn-sm btn-primary">S'abonner</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
