@extends('layout.admin')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="admin-form__gird playlist-grid">
            <label class="admin-label">
                <span>Название*</span>
                <input class="admin-input" type="text" name="title" maxlength="255"
                    value="{{ old('title') ?? $playlist->title }}" required>
                @error('title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label playlist-grid__description">
                <span>Описание</span>
                <textarea class="admin-input flex-grow-1" type="text" name="description" rows="3">{{ old('description') ?? $playlist->description }}</textarea>
                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Изображение</span>
                <input class="admin-input" type="file" name="image" value="{{ old('image') }}">
                @error('image')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        @if ($music->image)
            <div class="admin-form__image">
                <img src="{{ Storage::url('upload/image/' . $playlist->image) }}" width="100%" alt="">
            </div>
        @endif
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Жанр*</span>
                <select class="admin-input" name="genres_id" required>
                    @foreach ($genres as $genre)
                        <option {{ (old('genres_id') ?? $playlist->genres_id) == $genre->id ? 'selected' : '' }}
                            value="{{ $genre->id }}">{{ $genre->name }}
                        </option>
                    @endforeach
                </select>
                @error('genres_id')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Тема (через запятую)</span>
                <input class="admin-input" type="text" name="themes" value="{{ old('themes') ?? $themes }}">
                @error('themes')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Настроение (через запятую)</span>
                <input class="admin-input" type="text" name="moods" value="{{ old('moods') ?? $moods }}">
                @error('moods')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Инструменты (через запятую)</span>
                <input class="admin-input" type="text" name="instruments"
                    value="{{ old('instruments') ?? $instruments }}">
                @error('instruments')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-checkbox">
                <input class="admin-checkbox__input" type="checkbox" name="is_active"
                    {{ old('is_active') ?? $playlist->is_active ? 'checked' : '' }}>
                <span class="admin-checkbox__icon"></span>
                <span>Активен?</span>
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>seo title</span>
                <input class="admin-input" type="text" name="seo_title"
                    value="{{ old('seo_title') ?? $playlist->seo_title }}">
                @error('seo_title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label admin-form__flex_long">
                <span>seo description</span>
                <textarea class="admin-input" type="text" name="seo_description" rows="1">{{ old('seo_description') ?? $playlist->seo_description }}</textarea>
                @error('seo_description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <button class="admin-button">Сохранить</button>
    </form>
@endsection
