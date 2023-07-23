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
                <textarea class="summernote" name="content" id="content">{{ old('content') ?? $content }}</textarea>
                @error('content')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="admin-delete__buttons">
            <button class="admin-button">Сохранить</button>
            <a class="admin-button-red"
                href="{{ route('delete_confirm', [
                    'type' => 'pages',
                    'type_id' => $page->id,
                ]) }}">Удалить</a>
        </div>
    </form>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script type="text/javascript" defer>
        $('.summernote').summernote({
            height: 500
        });
    </script>
    @vite(['resources/js/front.js'])
@endsection
