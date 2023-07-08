@extends('layout.auth')

@section('seo_title', 'Sing in')

@section('html')
    <form class="auth-form" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="auth-form__title">Sing in</div>
        <div class="auth-form__inputs">
            <label class="admin-label">
                <span>E-mail</span>
                <input class="admin-input" type="email" name="email" value="{{ old('email') }}" />
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Password</span>
                <input class="admin-input" type="text" name="password" />
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <button class="admin-button auth-form__button">Sing in</button>
        <div class="auth-form__bottom">
            <span>Have an account?&nbsp;</span>
            <a class="auth-form__link" href="{{ route('register') }}">Sing up</a>
        </div>
    </form>
@endsection
