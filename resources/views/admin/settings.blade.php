@extends('layout.admin.index')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Путь к лого*</span>
                <input class="admin-input" type="text" name="logo"
                    value="{{ old('logo') ?? $site->logo }}" required>
                @error('logo')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Путь к иконке</span>
                <input class="admin-input" type="text" name="favicon"
                    value="{{ old('favicon') ?? $site->favicon }}">
                @error('favicon')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Название*</span>
                <input class="admin-input" type="text" name="name"
                    value="{{ old('name') ?? $site->name }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>seo title</span>
                <input class="admin-input" type="text" name="seo_title"
                    value="{{ old('seo_title') ?? $site->seo_title }}">
                @error('seo_title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label admin-form__flex_long">
                <span>seo description</span>
                <textarea class="admin-input" name="seo_description" rows="1">{{ old('seo_description') ?? $site->seo_description }}</textarea>
                @error('seo_description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Эл. почта</span>
                <input class="admin-input" type="email" name="email" value="{{ old('email') ?? $site->email }}">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Адрес</span>
                <input class="admin-input" type="text" name="address"
                    value="{{ old('address') ?? $site->address }}">
                @error('address')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Количество отображений в админке</span>
                <input class="admin-input" type="text" name="count_admin"
                    value="{{ old('count_admin') ?? $site->count_admin }}">
                @error('count_admin')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Количество отображений у пользователей</span>
                <input class="admin-input" type="text" name="count_front"
                    value="{{ old('count_front') ?? $site->count_front }}">
                @error('count_front')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <button class="admin-button">Сохранить</button>
    </form>
@endsection
