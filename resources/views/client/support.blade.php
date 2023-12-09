@extends('layout.client.index')

@section('html')
    <div class="container">
        <div id="support" class="content">
            <h2>Support</h2>
            <div class="feedback__container">
                <form class="admin-form" action="{{ url('/contacts') }}" method="post">
                    @csrf
                    <div class="admin-form__flex">
                        <label class="admin-label">
                            <span>E-mail*</span>
                            <input class="admin-input" type="text" name="email" maxlength="255"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </label>
                        <label class="admin-label">
                            <span>Theme</span>
                            <input class="admin-input" type="text" name="theme" maxlength="255"
                                value="{{ old('theme') }}">
                            @error('theme')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                    <div class="admin-form__flex">
                        <label class="admin-label w-100" style="flex-grow: 1;">
                            <span>Message</span>
                            <textarea class="admin-input" type="text" name="message">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                    @if (Session::has('success'))
                        <div class="feedback__success success">{{ Session::get('success') }}</div>
                    @endif
                    <div class="admin-delete__buttons">
                        <button class="admin-button admin-button-gradient">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
