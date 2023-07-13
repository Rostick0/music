@extends('layout.admin')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Название*</span>
                <input class="admin-input" type="text" name="name" maxlength="255" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Ссылка на music kit*</span>
                <input class="admin-input" type="text" name="link" maxlength="255" value="{{ old('link') }}"
                    required>
                @error('link')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <div class="admin-label" tabindex="0">
                <span>Название музыки*</span>
                <div class="admin-select-async music-select-async">
                    <input class="admin-input admin-select-async__input" type="text" maxlength="255" name="music_name"
                        value="{{ old('music_name') }}" required>
                    <input class="admin-select-async__value" name="music_id" value="{{ old('music_id') }}" required hidden>
                    <ul class="admin-select-async__list">
                        <li class="admin-select-async__item">1</li>
                    </ul>
                </div>
                @error('music_id')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="admin-form__flex">
            <label class="admin-checkbox">
                <input class="admin-checkbox__input" type="checkbox" name="is_active"
                    {{ old('is_active') ? 'checked' : '' }}>
                <span class="admin-checkbox__icon"></span>
                <span>Активен?</span>
            </label>
        </div>
        <button class="admin-button">Сохранить изменения</button>
    </form>
@endsection
