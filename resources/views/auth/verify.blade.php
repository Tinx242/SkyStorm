@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="text-center mb-3 mt-4">
                <img src="{{ asset('images/SkyStorm.svg') }}" alt="SkyStorm" height="50">
            </div>

            <div class="card shadow-sm">
                <div class="card-header fw-bold text-center">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <p class="text-muted">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                    </p>

                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-envelope"></i> {{ __('click here to request another') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
