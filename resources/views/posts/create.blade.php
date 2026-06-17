@extends('layouts.app')

@section('content')
    <h4 class="mb-4 fw-bold">Nouveau post</h4>

    <div class="card shadow-sm">
        <div class="card-header fw-bold">
            <i class="bi bi-pen"></i> {{ __('Nouveau post') }}
        </div>
        <div class="card-body">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <textarea name="content" class="form-control mb-2" rows="4" placeholder="Quoi de neuf ?"></textarea>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-send"></i> Publier
                </button>
            </form>
        </div>
    </div>
@endsection
