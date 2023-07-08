@extends('layout.auth')

@section('seo_title', 'Sing up')

@section('html')
    <form class="auth-form auth-form-register" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="auth-form__title">Sing up</div>
        <div class="auth-form__inputs auth-form-register__inputs">
            <label class="admin-label">
                <span>Name</span>
                <input class="admin-input" type="text" name="name" value="{{ old('name') }}" />
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Surname</span>
                <input class="admin-input" type="text" name="surname" value="{{ old('surname') }}" />
                @error('surname')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Nickname</span>
                <input class="admin-input" type="text" name="nickname" value="{{ old('nickname') }}" />
                @error('nickname')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Telephone</span>
                <input class="admin-input" type="text" name="telephone" value="{{ old('telephone') }}" />
                @error('telephone')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label auth-form-register__label-long">
                <span>E-mail</span>
                <input class="admin-input" type="email" name="email" value="{{ old('email') }}" />
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Password</span>
                <input class="admin-input" type="password" name="password" />
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Password confirm</span>
                <input class="admin-input" type="password" name="password_confirmation" />
            </label>
        </div>
        <button class="admin-button auth-form__button auth-form-register__button">Sing up</button>
        <div class="auth-form__bottom">
            <span>Don't have an account?&nbsp;</span>
            <a class="auth-form__link" href="{{ route('login') }}">Sing in</a>
        </div>
    </form>
@endsection
