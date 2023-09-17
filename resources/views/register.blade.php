@extends('layout.front.index')

@section('seo_title', 'Sign up')

@section('html')
    <div class="container auth">
        <form class="auth-form auth-form-register" action="{{ url()->current() }}" method="post">
            @csrf
            <div class="auth-form__title">Sign up</div>
            <div class="auth-form__inputs auth-form-register__inputs">
                <label class="label">
                    <span>Name*</span>
                    <input class="input-form" type="text" name="name" value="{{ old('name') }}" required />
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="label">
                    <span>Surname</span>
                    <input class="input-form" type="text" name="surname" value="{{ old('surname') }}" />
                    @error('surname')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="label">
                    <span>Nickname*</span>
                    <input class="input-form" type="text" name="nickname" value="{{ old('nickname') }}" required />
                    @error('nickname')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="label">
                    <span>Telephone*</span>
                    <input class="input-form" type="tel" name="telephone" value="{{ old('telephone') }}" />
                    @error('telephone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="label auth-form-register__label-long">
                    <span>E-mail*</span>
                    <input class="input-form" type="email" name="email" value="{{ old('email') }}" required />
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="label">
                    <span>Password*</span>
                    <input class="input-form" type="password" name="password" minlength="8" required />
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="label">
                    <span>Password confirm*</span>
                    <input class="input-form" type="password" name="password_confirmation" required />
                </label>
            </div>
            <button class="admin-button auth-form__button auth-form-register__button">Sign up</button>
            <div class="auth-form__bottom">
                <span>Don't have an account?&nbsp;</span>
                <a class="auth-form__link" href="{{ route('login') }}">Sign in</a>
            </div>
        </form>
    </div>
@endsection
