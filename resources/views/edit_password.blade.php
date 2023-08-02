@extends('layout.front.index')

@section('seo_title', 'New password')

@section('html')
    <div class="container auth">
        <form class="auth-form" action="{{ url()->current() }}" method="post">
            @csrf
            <div class="auth-form__title">New password</div>
            <div class="auth-form__inputs auth-form-register__inputs">
                <input type="hidden" name="token" value="{{ $token }}">
                <label class="label">
                    <span>E-mail*</span>
                    <input class="input-form" type="email" name="email" required />
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
            <button class="admin-button auth-form__button auth-form-register__button">Edit</button>
        </form>
    </div>
@endsection
