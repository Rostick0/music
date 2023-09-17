@extends('layout.front.index')

@section('seo_title', 'Sign in')

@section('html')
    <div class="container auth">
        <form class="auth-form" action="{{ url()->current() }}" method="post">
            @csrf
            <div class="auth-form__title">Sign in</div>
            @if (Session::has('success'))
                <div class="auth-form__success success">{{ Session::get('success') }}</div>
            @endif
            <div class="auth-form__inputs">
                <label class="label">
                    <span>E-mail</span>
                    <input class="input-form" type="email" name="email" value="{{ old('email') }}" required />
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="label">
                    <span>Password</span>
                    <input class="input-form" type="text" name="password" required />
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <button class="button-gradient auth-form__button">Sign in</button>
            <div class="auth-form__bottom">
                <span>Have an account?&nbsp;</span>
                <a class="auth-form__link" href="{{ route('register') }}">Sign up</a>
                or
                <a class="auth-form__link" href="{{ route('password.email') }}">Recovery</a>
            </div>
        </form>
    </div>
@endsection
