@extends('layout.admin')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Исполнитель</span>
                <input class="admin-input" type="text" name="music_artists" maxlength="255"
                    value="{{ old('music_artists') ?? $music_artist->name }}" required>
                @error('music_artists')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Название</span>
                <input class="admin-input" type="text" name="title" maxlength="255"
                    value="{{ old('title') ?? $music->title }}" required>
                @error('title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Ссылка на трэк</span>
                <input class="admin-input" type="text" name="link" maxlength="255"
                    value="{{ old('link') ?? $music->link }}" required>
                @error('music_artists')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Ссылка на демо трэк</span>
                <input class="admin-input" type="text" name="link_demo" maxlength="255"
                    value="{{ old('link_demo') ?? $music->link_demo }}" required>
                @error('link_demo')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Ссылка на публикатор</span>
                <input class="admin-input" type="text" name="publisher" maxlength="255"
                    value="{{ old('publisher') ?? $music->publisher }}">
                @error('publisher')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Ссылка на дистрибьютор</span>
                <input class="admin-input" type="text" name="distr" maxlength="255"
                    value="{{ old('distr') ?? $music->distr }}">
                @error('distr')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Ссылка на дистрибьютор</span>
                <input class="admin-input" type="date" name="create_date"
                    value="{{ old('create_date') ?? $music->create_date }}" maxlength="255">
                @error('create_date')
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
                <span>Жанр</span>
                <select class="admin-input" name="genres_id" required>
                    @foreach ($genres as $genre)
                        <option {{ (old('genres_id') ?? $music->genres_id) == $genre->id ? 'selected' : '' }}
                            value="{{ $genre->id }}">{{ $genre->name }}
                        </option>
                    @endforeach
                </select>
                @error('genres_id')
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
        </div>
        <div class="admin-form__flex">
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
                    {{ old('is_active') ?? $music->is_active ? 'checked' : '' }}>
                <span class="admin-checkbox__icon"></span>
                <span>Активен?</span>
            </label>
            <label class="admin-checkbox">
                <input class="admin-checkbox__input" type="checkbox" name="is_free"
                    {{ old('is_free') ?? $music->is_free ? 'checked' : '' }}>
                <span class="admin-checkbox__icon"></span>
                <span>Бесплатный?</span>
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label admin-form__flex_long">
                <span>Описание трека</span>
                <textarea class="admin-input" type="text" name="description" rows="3">{{ old('description') ?? $music->description }}</textarea>
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
                <img src="{{ Storage::url('upload/image/' . $music->image) }}" width="100%" alt="">
            </div>
        @endif
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>seo title</span>
                <input class="admin-input" type="text" name="seo_title"
                    value="{{ old('seo_title') ?? $music->seo_title }}">
                @error('seo_title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label admin-form__flex_long">
                <span>seo description</span>
                <textarea class="admin-input" type="text" name="seo_description" rows="1">{{ old('seo_description') ?? $music->seo_description }}</textarea>
                @error('seo_description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <button class="admin-button">Сохранить изменения</button>
    </form>
@endsection
