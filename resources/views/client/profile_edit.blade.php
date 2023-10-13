@extends('layout.client.index')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post">
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
            <button class="admin-button">Edit</button>
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
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>New password*</span>
                <input class="admin-input" type="text" name="password" maxlength="255" required>
                @error('surname')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Confirm password*</span>
                <input class="admin-input" type="text" name="password_confirmation" maxlength="255" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-delete__buttons">
            <button class="admin-button">Edit</button>
        </div>
    </form>
@endsection
