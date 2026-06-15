@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="mb-4">Mes Notes</h2>
            <div class="col-md-8">
                @foreach ($notes as $note)
                    <div class="card mb-3">
                        <div class="card-header">{{ __('Mes Notes') }}</div>

                        <div class="card-body">
                            <p>{{ $note->content }}</p>

                            <div class="d-flex gap-2">

                                <form action="{{ route('notes.toPost', $note) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Transformer en post</button>
                                </form>

                                <form action="{{ route('notes.destroy', $note) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
