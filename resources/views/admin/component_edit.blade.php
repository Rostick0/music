@extends('layout.admin.index')

@section('html')
    @vite(['resources/scss/front/index.scss'])
    <form class="admin-form" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Название*</span>
                <input class="admin-input" type="text" name="name" maxlength="255"
                    value="{{ old('name') ?? $component->name }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Путь*</span>
                <input class="admin-input" type="text" name="path" maxlength="255"
                    value="{{ old('path') ?? $component->path }}" required>
                @error('path')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <div class="admin-label admin-form__flex_long admin-form__flex_100">
                <span>Код компонента</span>
                <textarea class="summernote" name="content" id="content">{{ old('content') ?? $content }}</textarea>
                @error('content')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="admin-buttons admin-button__margin-top">
            <button class="admin-button">Сохранить</button>
            <a class="admin-button-red"
                href="{{ route('delete_confirm', [
                    'type' => 'components',
                    'type_id' => $component->id,
                ]) }}">Удалить</a>
        </div>
    </form>

    <x-summernote_links></x-summernote_links>
    @vite(['resources/js/front.js'])
@endsection
