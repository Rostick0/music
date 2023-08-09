@extends('layout.admin.index')

@php
    $check_link = App\Http\Controllers\MusicUploadController::check($music->link);
    $check_demo = App\Http\Controllers\MusicUploadController::check($music->link_demo, 'music_demo');
@endphp

@section('html')
    {{-- {{ dd($music->theme) }} --}}
    <form class="admin-form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Исполнитель*</span>
                <input class="admin-input" type="text" name="music_artists" maxlength="255"
                    value="{{ old('music_artists') ?? $music_artist->name }}" required>
                @error('music_artists')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Название*</span>
                <input class="admin-input" type="text" name="title" maxlength="255"
                    value="{{ old('title') ?? $music->title }}" required>
                @error('title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Трэк*</span>
                <span class="admin-file-upload">
                    <input class="admin-file-upload__input" type="file" name="link" accept=".mp3"
                        value="{{ old('link') }}">
                    <span class="admin-input">
                        <span class="admin-file-upload__name">{{ $check_link ? 'Загружен' : 'Загрузить файл' }}</span>
                    </span>
                </span>
                @error('link')
                    <span class="error">{{ $message }}</span>
                @enderror
                @if ($check_link)
                    <span>{{ App\Http\Controllers\MusicUploadController::getViewLink($music->link) }}</span>
                    <audio class="admin-audio" src="{{ Storage::url('upload/music/' . $music->link) }}" controls></audio>
                @endif
            </label>
            <label class="admin-label">
                <span>Демо трэк</span>
                <span class="admin-file-upload">
                    <input class="admin-file-upload__input" type="file" name="link_demo" accept=".mp3"
                        value="{{ old('link_demo') }}">
                    <span class="admin-input">
                        <span class="admin-file-upload__name">{{ $check_demo ? 'Загружен' : 'Загрузить файл' }}</span>
                    </span>
                </span>
                @error('link_demo')
                    <span class="error">{{ $message }}</span>
                @enderror
                @if ($check_demo)
                    <span>{{ App\Http\Controllers\MusicUploadController::getViewLink($music->link) }}</span>
                    <audio class="admin-audio" src="{{ Storage::url('upload/music_demo/' . $music->link_demo) }}"
                        controls></audio>
                @endif
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
                <span>Тема (через запятую)</span>
                <input class="admin-input" type="text" name="themes"
                    value="{{ old('themes') ?? App\Http\Controllers\RelationshipHelper::getNameByItems($music->themes) }}">
                @error('themes')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
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
                <span>Настроение (через запятую)</span>
                <input class="admin-input" type="text" name="moods"
                    value="{{ old('moods') ?? App\Http\Controllers\RelationshipHelper::getNameByItems($music->moods) }}">
                @error('moods')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Инструменты (через запятую)</span>
                <input class="admin-input" type="text" name="instruments"
                    value="{{ old('instruments') ?? App\Http\Controllers\RelationshipHelper::getNameByItems($music->instruments) }}">
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
                <input class="admin-input" type="file" name="image" value="{{ old('image') }}" accept="image/png, image/gif, image/jpeg">
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
        <div class="admin-delete__buttons">
            <button class="admin-button">Сохранить изменения</button>
            <a class="admin-button-red"
                href="{{ route('delete_confirm', [
                    'type' => 'music',
                    'type_id' => $music->id,
                ]) }}">Удалить</a>
        </div>
    </form>
    <br>
    <h2>Партии музыки</h2>
    <form class="admin-form" action="{{ route('part.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="admin-form__flex">
            <input type="hidden" name="type" value="music">
            <input type="hidden" name="type_id" value="{{ $music->id }}">
            <label class="admin-label admin-form__flex_long">
                <span>Название</span>
                <input class="admin-input" type="text" name="part_name" value="{{ old('part_name') }}"
                    maxlength="255" required>
                @error('part_name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Трэк*</span>
                <span class="admin-file-upload">
                    <input class="admin-file-upload__input" type="file" name="part_link" accept=".mp3"
                        value="{{ old('part_link') }}" required>
                    <span class="admin-input">
                        <span class="admin-file-upload__name">Загрузить файл</span>
                    </span>
                </span>
                @error('part_link')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-delete__buttons">
            <button class="admin-button">Добавить</button>
        </div>
    </form>
    <br>
    <div class="admin-form">
        @foreach ($music->parts as $part)
            <div class="admin-form__flex aling-items-end">
                <label class="admin-label">
                    <span>Название</span>
                    <input class="admin-input" type="text" value="{{ $part->name }}" disabled>
                </label>
                <label class="admin-label">
                    <span>Страница</span>
                    <input class="admin-input" type="text" value="{{ $part->link }}" disabled>
                    <audio src=""></audio>
                </label>
                <div class="admin-buttons">
                    <form action="{{ route('part.delete', ['id' => $part->id]) }}" method="post">
                        @csrf
                        <button class="admin-button-red">Удалить</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
