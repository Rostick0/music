@extends('layout.front.index')

@section('seo_title', 'Reset password')

@section('html')
    <div class="container auth">
        <form class="auth-form" action="{{ url()->current() }}" method="post">
            @csrf
            <div class="auth-form__title">Password Reset</div>
            <div class="auth-form__inputs auth-form-register__inputs">
                <label class="label auth-form-register__label-long">
                    <span>E-mail*</span>
                    <input class="input-form" type="email" placeholder="Your email" name="email" value="{{ old('email') }}" required />
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <button class="admin-button auth-form__button auth-form-register__button">send</button>
        </form>
    </div>
@endsection
