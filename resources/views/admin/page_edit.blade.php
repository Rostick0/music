@extends('layout.admin.index')

@section('html')
    @vite(['resources/scss/front/index.scss'])
    <form class="admin-form" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Название*</span>
                <input class="admin-input" type="text" name="name" maxlength="255" value="{{ old('name') ?? $page->name }}"
                    required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>URL*</span>
                <input class="admin-input" type="text" name="url" maxlength="255"
                    value="{{ old('url') ?? $page->url }}" required>
                @error('url')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Путь*</span>
                <input class="admin-input" type="text" name="path" maxlength="255"
                    value="{{ old('path') ?? $page->path }}" required>
                @error('path')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-checkbox">
                <input class="admin-checkbox__input" type="checkbox" name="is_active"
                    {{ old('is_active') ?? $page->is_active ? 'checked' : '' }}>
                <span class="admin-checkbox__icon"></span>
                <span>Активна?</span>
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>seo title</span>
                <input class="admin-input" type="text" name="seo_title"
                    value="{{ old('seo_title') ?? $page->seo_title }}">
                @error('seo_title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label admin-form__flex_long">
                <span>seo description</span>
                <textarea class="admin-input" name="seo_description" rows="1">{{ old('seo_description') ?? $page->seo_description }}</textarea>
                @error('seo_description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <div class="admin-label admin-form__flex_long admin-form__flex_100">
                <span>Контент страницы</span>
                <textarea class="summernote" name="content" id="content">{!! old('content') ?? $htmlSection($content) !!}</textarea>
                @error('content')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="admin-delete__buttons admin-button__margin-top">
            <button class="admin-button admin-delete__button">Сохранить</button>
            <a class="admin-button-red admin-delete__button"
                href="{{ route('delete_confirm', [
                    'type' => 'site_pages',
                    'type_id' => $page->id,
                ]) }}">Удалить</a>
        </div>
    </form>
    <style>
        .admin-delete__buttons {
            display: flex;
            column-gap: 10px;
        }

        .admin-delete__button {
            font-size: 16px;
        }
    </style>
    <x-summernote_links></x-summernote_links>
    @vite(['resources/js/front.js'])
@endsection
