@extends('layouts.app')

@section('content')
    <h4 class="mb-4 fw-bold">Nouvelle note</h4>

    <div class="card shadow-sm">
        <div class="card-header fw-bold">
            <i class="bi bi-journal-text"></i> {{ __('Nouvelle note') }}
        </div>
        <div class="card-body">
            <form action="{{ route('notes.store') }}" method="POST">
                @csrf
                <textarea name="content" class="form-control mb-2" rows="4" placeholder="Écrivez votre note..."></textarea>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-save"></i> Enregistrer
                </button>
            </form>
        </div>
    </div>
@endsection
