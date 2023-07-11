@extends('layout.admin')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Имя</span>
                <input class="admin-input" type="text" name="name" maxlength="255" value="{{ old('name') ?? $user->name }}"
                    required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Фамилия</span>
                <input class="admin-input" type="text" name="surname" maxlength="255"
                    value="{{ old('surname') ?? $user->surname }}" required>
                @error('surname')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Эл. почта</span>
                <input class="admin-input" type="text" name="email" maxlength="255"
                    value="{{ old('email') ?? $user->email }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Телефон</span>
                <input class="admin-input" type="tel" name="telephone" maxlength="255"
                    value="{{ old('telephone') ?? $user->telephone }}" required>
                @error('telephone')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Дата регистрация</span>
                <input class="admin-input" type="text" maxlength="255" value="{{ $user->created_at }}" disabled>
            </label>
            <label class="admin-label">
                <span>Дата начало подписки</span>
                <span class="admin-input">{{ $subscription->created_at ?? '-' }}</span>
            </label>
            <label class="admin-label">
                <span>Дата окончания</span>
                <span class="admin-input">{{ $subscription->date_end ?? '-' }}</span>
            </label>
            <label class="admin-checkbox">
                <input class="admin-checkbox__input" type="checkbox" name="is_auto_renewal"
                    {{ old('is_auto_renewal') ?? ($subscription->is_auto_renewal ?? false) ? 'checked' : '' }} disabled>
                <span class="admin-checkbox__icon"></span>
                <span>Автопродление подписки?</span>
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-checkbox">
                <input class="admin-checkbox__input" type="checkbox" name="is_active"
                    {{ old('is_active') ?? $user->is_active ? 'checked' : '' }}>
                <span class="admin-checkbox__icon"></span>
                <span>Активен?</span>
            </label>
        </div>

        <button class="admin-button">Сохранить изменения</button>
    </form>
@endsection
