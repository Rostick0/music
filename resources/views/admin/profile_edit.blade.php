@extends('layout.admin.index')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Имя*</span>
                <input class="admin-input" type="text" name="name" maxlength="255" value="{{ old('name') ?? $user->name }}"
                    required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Фамилия*</span>
                <input class="admin-input" type="text" name="surname" maxlength="255"
                    value="{{ old('surname') ?? $user->surname }}" required>
                @error('surname')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            {{-- <label class="admin-label">
                <span>Эл. почта*</span>
                <input class="admin-input" type="text" name="email" maxlength="255"
                    value="{{ old('email') ?? $user->email }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label> --}}
            <label class="admin-label">
                <span>Телефон</span>
                <input class="admin-input" type="tel" name="telephone" maxlength="255"
                    value="{{ old('telephone') ?? $user->telephone }}">
                @error('telephone')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-delete__buttons">
            <button class="admin-button">Изменить</button>
        </div>
    </form>
    <br>
    <br>
    <form class="admin-form" action="{{ route('admin.profile_password') }}" method="post">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Текущий пароль*</span>
                <input class="admin-input" type="password" name="old_password" maxlength="255" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Новый пароль*</span>
                <input class="admin-input" type="text" name="password" maxlength="255" required>
                @error('surname')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Подтвердите пароль*</span>
                <input class="admin-input" type="text" name="password_confirmation" maxlength="255" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-delete__buttons">
            <button class="admin-button">Изменить</button>
        </div>
    </form>
@endsection
