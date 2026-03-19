@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ __('Nouveau Posts') }}</div>

                        <div class="card-body">
                            <form action="{{route('posts.store')}}"method="POST">
                                @csrf
                                <textarea name="content" style  = "width: 100%"></textarea><br>
                                <button type="submit"> Envoyer</button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
