@extends('layout.client.index')

@section('html')
    <div class="container">
        <div id="settings" class="content">
            <h2>Settings</h2>
            <form class="admin-form" action="{{ route('client.profile_edit') }}" method="post">
                @csrf
                <div class="admin-form__flex">
                    <label class="admin-label">
                        <span>Name*</span>
                        <input class="admin-input" type="text" name="name" maxlength="255" value="{{ old('name') ?? $user->name }}"
                            required>
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </label>
                    <label class="admin-label">
                        <span>Surname*</span>
                        <input class="admin-input" type="text" name="surname" maxlength="255"
                            value="{{ old('surname') ?? $user->surname }}" required>
                        @error('surname')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div class="admin-form__flex">
                    <label class="admin-label">
                        <span>E-mail*</span>
                        <input class="admin-input" type="text" name="email" maxlength="255"
                            value="{{ old('email') ?? $user->email }}" required>
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </label>
                    <label class="admin-label">
                        <span>Phone</span>
                        <input class="admin-input" type="tel" name="telephone" maxlength="255"
                            value="{{ old('telephone') ?? $user->telephone }}">
                        @error('telephone')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div class="admin-delete__buttons">
                    <button class="admin-button admin-button-gradient">Edit</button>
                </div>
            </form>
            <br>
            <br>
            <form class="admin-form" action="{{ route('client.profile_password') }}" method="post">
                @csrf
                <div class="admin-form__flex">
                    <label class="admin-label">
                        <span>Current password*</span>
                        <input class="admin-input" type="password" name="old_password" maxlength="255" required>
                        @error('old_password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div class="admin-form__flex">
                    <label class="admin-label">
                        <span>New password*</span>
                        <input class="admin-input" type="text" name="password" maxlength="255" required>
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </label>
                    <label class="admin-label">
                        <span>Confirm password*</span>
                        <input class="admin-input" type="text" name="password_confirmation" maxlength="255" required>
                        @error('password_confirmation')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div class="admin-delete__buttons">
                    <button class="admin-button admin-button-gradient">Edit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
