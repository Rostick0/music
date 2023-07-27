@extends('layout.auth.index')

@section('seo_title', 'Email Confirm')

@section('html')
    <div class="auth-form" method="post">
        <div class="auth-form__title">Please confirm your email</div>
        <div class="auth-form__bottom">
            <a class="auth-form__link" href="{{ route('verification.send') }}">Send code</a>
        </div>
    </div>
@endsection
