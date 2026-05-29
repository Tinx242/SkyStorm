@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <table>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user -> name}}</td>
                        <td>
                            <form action="{{route('users.follow')}}" method="post">
                                @csrf
                                <input type="hidden" name="following_id" value="{{$user->id}}">
                                <button type="submit" class="btn btn-sm btn-link">Follow</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
