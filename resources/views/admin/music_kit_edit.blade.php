@extends('layout.admin.index')

@php
    $check_link = App\Http\Controllers\MusicUploadController::check($music_kit->link, 'music_kit');
    $check_demo = App\Http\Controllers\MusicUploadController::check($music_kit->link_demo, 'music_kit_demo');
@endphp

@section('html')
    <div class="admin-content__inner_gap">
        <form class="admin-form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="admin-form__flex">
                <label class="admin-label">
                    <span>Исполнитель*</span>
                    <input class="admin-input" type="text" name="music_artists" maxlength="255"
                        value="{{ old('music_artists') ?? $music_artist->artist_name }}" required>
                    @error('music_artists')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="admin-label">
                    <span>Название*</span>
                    <input class="admin-input" type="text" name="title" maxlength="255"
                        value="{{ old('title') ?? $music_kit->title }}" required>
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <div class="admin-form__flex">
                <label class="admin-label">
                    <span>Трэк*</span>
                    <span class="admin-file-upload">
                        <input class="admin-file-upload__input" type="file" name="link" accept=".mp3,.wav"
                            value="{{ old('link') }}">
                        <span class="admin-input">
                            <span class="admin-file-upload__name">{{ $check_link ? 'Загружен' : 'Загрузить файл' }}</span>
                        </span>
                    </span>
                    @error('link')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    @if ($check_link)
                        <span>{{ App\Http\Controllers\MusicUploadController::getViewLink($music_kit->link, 'music_kit') }}</span>
                        <audio class="admin-audio"
                            src="{{ Storage::url('upload/music_kit/' . $music_kit->link, 'music_kit') }}" controls></audio>
                    @endif
                </label>
                <label class="admin-label">
                    <span>Демо трэк</span>
                    <span class="admin-file-upload">
                        <input class="admin-file-upload__input" type="file" name="link_demo" accept=".mp3,.wav"
                            value="{{ old('link_demo') }}">
                        <span class="admin-input">
                            <span class="admin-file-upload__name">{{ $check_demo ? 'Загружен' : 'Загрузить файл' }}</span>
                        </span>
                    </span>
                    @error('link_demo')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    @if ($check_demo)
                        <span>{{ App\Http\Controllers\MusicUploadController::getViewLink($music_kit->link_demo, 'music_kit_demo') }}</span>
                        <audio class="admin-audio"
                            src="{{ Storage::url('upload/music_kit_demo/' . $music_kit->link_demo) }}" controls></audio>
                    @endif
                </label>
                <label class="admin-label">
                    <span>Ссылка на паблишер</span>
                    <input class="admin-input" type="text" name="publisher" maxlength="255"
                        value="{{ old('publisher') ?? $music_kit->publisher }}">
                    @error('publisher')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="admin-label">
                    <span>Ссылка на дистрибьютор</span>
                    <input class="admin-input" type="text" name="distr" maxlength="255"
                        value="{{ old('distr') ?? $music_kit->distr }}">
                    @error('distr')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <div class="admin-form__flex">
                <label class="admin-label">
                    <span>Тема</span>
                    <details class="admin-details">
                        <summary class="admin-details__summary">
                            <div class="admin-input">Тема</div>
                        </summary>
                        <div class="admin-details__content">
                            @foreach ($themes as $theme)
                                <label class="admin-checkbox">
                                    <input class="admin-checkbox__input" type="checkbox" name="themes[]"
                                        @if (array_search($theme->id, Request::get('themes') ?? []) !== false || isset($theme->relationship_id)) checked @endif value="{{ $theme->id }}">
                                    <span class="admin-checkbox__icon"></span>
                                    <span>{{ $theme->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </details>
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
                        value="{{ old('moods') ?? App\Http\Controllers\RelationshipHelper::getNameByItems($music_kit->moods) }}">
                    @error('moods')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <div class="admin-form__flex">
                <label class="admin-label">
                    <span>Инструменты (через запятую)</span>
                    <input class="admin-input" type="text" name="instruments"
                        value="{{ old('instruments') ?? App\Http\Controllers\RelationshipHelper::getNameByItems($music_kit->instruments) }}">
                    @error('instruments')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <div class="admin-form__flex">
                <label class="admin-checkbox">
                    <input class="admin-checkbox__input" type="checkbox" name="is_active"
                        {{ old('is_active') ?? $music_kit->is_active ? 'checked' : '' }}>
                    <span class="admin-checkbox__icon"></span>
                    <span>Активен?</span>
                </label>
                <label class="admin-checkbox">
                    <input class="admin-checkbox__input" type="checkbox" name="is_free"
                        {{ old('is_free') ?? $music_kit->is_free ? 'checked' : '' }}>
                    <span class="admin-checkbox__icon"></span>
                    <span>Бесплатный?</span>
                </label>
            </div>
            <div class="admin-form__flex">
                <label class="admin-label admin-form__flex_long">
                    <span>Описание трека</span>
                    <textarea class="admin-input" type="text" name="description" rows="3">{{ old('description') ?? $music_kit->description }}</textarea>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="admin-label">
                    <span>Изображение</span>
                    <input class="admin-input" type="file" name="image" value="{{ old('image') }}"
                        accept="image/png, image/gif, image/jpeg">
                    @error('image')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
            </div>
            @if ($music_kit->image)
                <div class="admin-form__image">
                    <img src="{{ Storage::url('upload/image/' . $music_kit->image) }}" width="100%" alt="">
                </div>
            @endif
            <div class="admin-form__flex">
                <label class="admin-label">
                    <span>seo title</span>
                    <input class="admin-input" type="text" name="seo_title"
                        value="{{ old('seo_title') ?? $music_kit->seo_title }}">
                    @error('seo_title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="admin-label admin-form__flex_long">
                    <span>seo description</span>
                    <textarea class="admin-input" type="text" name="seo_description" rows="1">{{ old('seo_description') ?? $music_kit->seo_description }}</textarea>
                    @error('seo_description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <div class="admin-delete__buttons">
                <button class="admin-button">Сохранить изменения</button>
                <a class="admin-button-red"
                    href="{{ route('delete_confirm', [
                        'type' => 'music_kits',
                        'type_id' => $music_kit->id,
                    ]) }}">Удалить</a>
            </div>
        </form>
        <div>
            <h2 class="admin-content__title">Партии музыки</h2>
            <form class="admin-form" action="{{ route('part.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="admin-form__flex">
                    <input type="hidden" name="type" value="music_kit">
                    <input type="hidden" name="type_id" value="{{ $music_kit->id }}">
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
                            <input class="admin-file-upload__input" type="file" name="part_link" accept=".mp3,.wav"
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
        </div>
        <div class="admin-form">
            @foreach ($music_kit->parts as $part)
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
    </div>
@endsection
