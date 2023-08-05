@extends('layout.admin.index')

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
        @if (App\Http\Controllers\ImageController::check($playlist->image))
            <div class="admin-form__image">
                <img src="{{ Storage::url('upload/image/' . $playlist->image) }}" width="100%" alt="">
            </div>
        @endif
        <div class="admin-form__flex">
            <div class="admin-label w-100">
                <span>Жанр</span>
                <details class="admin-details">
                    <summary class="admin-details__summary">
                        <div class="admin-input">Жанр</div>
                    </summary>
                    <div class="admin-details__content">
                        @foreach ($genres as $genre)
                            <label class="admin-checkbox">
                                <input class="admin-checkbox__input" type="checkbox" name="genres[]"
                                    @if (array_search($genre->id, Request::get('genres') ?? []) !== false || isset($genre->relationship_id)) checked @endif value="{{ $genre->id }}">
                                <span class="admin-checkbox__icon"></span>
                                <span>{{ $genre->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </details>
            </div>
            <label class="admin-label">
                <span>Тема (через запятую)</span>
                <input class="admin-input" type="text" name="themes"
                    value="{{ old('themes') ?? App\Http\Controllers\RelationshipHelper::getNameByItems($playlist->themes, '—') }}">
                @error('themes')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Настроение (через запятую)</span>
                <input class="admin-input" type="text" name="moods"
                    value="{{ old('moods') ?? App\Http\Controllers\RelationshipHelper::getNameByItems($playlist->moods, '—') }}">
                @error('moods')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Инструменты (через запятую)</span>
                <input class="admin-input" type="text" name="instruments"
                    value="{{ old('instruments') ?? App\Http\Controllers\RelationshipHelper::getNameByItems($playlist->instruments, '—') }}">
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
        <div class="admin-delete__buttons">
            <button class="admin-button">Сохранить</button>
            <a class="admin-button-red"
                href="{{ route('delete_confirm', [
                    'type' => 'pages',
                    'type_id' => $playlist->id,
                ]) }}">Удалить</a>
        </div>
    </form>
    <br>
    <div class="admin-form__flex">
        <a class="admin-button admin-button-add-form"
            href="{{ route('playlist.music.list', ['playlist_id' => $playlist->id]) }}">
            <span class="admin-button-add__plus">+</span>
            <span>Добавить музыку</span>
        </a>
    </div>
    <br>
    <h2>Список музыки</h2>
    @if (!empty($playlist->music))
        <div class="admin-form__list">
            @foreach ($playlist->music as $music)
                <div class="admin-form__item">
                    <div>{{ $music->title }}</div>
                    <a
                        href="{{ route('music.edit', [
                            'id' => $music->id,
                        ]) }}">{{ App\Http\Controllers\MusicUploadController::getViewLink($music->link) }}</a>
                    <form
                        action="{{ route('playlist.music.delete', [
                            'id' => $music->relationship_playlist_id,
                        ]) }}"
                        method="post">
                        @csrf
                        <button class="admin-button-red">Удалить</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
@endsection
