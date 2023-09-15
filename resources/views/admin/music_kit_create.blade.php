@extends('layout.admin.index')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Исполнитель*</span>
                <input class="admin-input" type="text" name="music_artists" maxlength="255"
                    value="{{ old('music_artists') }}" required>
                @error('music_artists')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Название*</span>
                <input class="admin-input" type="text" name="title" maxlength="255" value="{{ old('title') }}"
                    required>
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
                        value="{{ old('link') }}" required>
                    <span class="admin-input">
                        <span class="admin-file-upload__name">Загрузить файл</span>
                    </span>
                </span>
                @error('link')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Демо трэк*</span>
                <span class="admin-file-upload">
                    <input class="admin-file-upload__input" type="file" name="link_demo" accept=".mp3,.wav"
                        value="{{ old('link_demo') }}" required>
                    <span class="admin-input">
                        <span class="admin-file-upload__name">Загрузить файл</span>
                    </span>
                </span>
                @error('link_demo')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Ссылка на паблишер</span>
                <input class="admin-input" type="text" name="publisher" maxlength="255" value="{{ old('publisher') }}">
                @error('publisher')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Ссылка на дистрибьютор</span>
                <input class="admin-input" type="text" name="distr" maxlength="255" value="{{ old('distr') }}">
                @error('distr')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <div class="admin-label">
                <span>Genres</span>
                <details class="admin-details">
                    <summary class="admin-details__summary">
                        <div class="admin-input">Жанры</div>
                    </summary>
                    <div class="admin-details__content">
                        @foreach ($genres as $genre)
                            <label class="admin-checkbox">
                                <input class="admin-checkbox__input" type="checkbox" name="genres[]"
                                    @if (array_search($genre->id, Request::get('genres') ?? []) !== false) checked @endif value="{{ $genre->id }}">
                                <span class="admin-checkbox__icon"></span>
                                <span>{{ $genre->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </details>
            </div>
            <label class="admin-label">
                <span>Moods</span>
                <details class="admin-details">
                    <summary class="admin-details__summary">
                        <div class="admin-input">Настроение</div>
                    </summary>
                    <div class="admin-details__content">
                        @foreach ($moods as $mood)
                            <label class="admin-checkbox">
                                <input class="admin-checkbox__input" type="checkbox" name="moods[]"
                                    @if (array_search($mood->id, Request::get('moods') ?? []) !== false) checked @endif value="{{ $mood->id }}">
                                <span class="admin-checkbox__icon"></span>
                                <span>{{ $mood->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </details>
            </label>
            <div class="admin-label">
                <span>Themes</span>
                <details class="admin-details">
                    <summary class="admin-details__summary">
                        <div class="admin-input">Тема</div>
                    </summary>
                    <div class="admin-details__content">
                        @foreach ($themes as $theme)
                            <label class="admin-checkbox">
                                <input class="admin-checkbox__input" type="checkbox" name="themes[]"
                                    @if (array_search($theme->id, Request::get('themes') ?? []) !== false) checked @endif value="{{ $theme->id }}">
                                <span class="admin-checkbox__icon"></span>
                                <span>{{ $theme->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </details>
            </div>
            <label class="admin-label">
                <span>Instruments</span>
                <details class="admin-details">
                    <summary class="admin-details__summary">
                        <div class="admin-input">Инструмент</div>
                    </summary>
                    <div class="admin-details__content">
                        @foreach ($instruments as $instrument)
                            <label class="admin-checkbox">
                                <input class="admin-checkbox__input" type="checkbox" name="instruments[]"
                                    @if (array_search($instrument->id, Request::get('instruments') ?? []) !== false) checked @endif value="{{ $instrument->id }}">
                                <span class="admin-checkbox__icon"></span>
                                <span>{{ $instrument->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </details>
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-checkbox">
                <input class="admin-checkbox__input" type="checkbox" name="is_active"
                    {{ old('is_active') ? 'checked' : '' }}>
                <span class="admin-checkbox__icon"></span>
                <span>Активен?</span>
            </label>
            <label class="admin-checkbox">
                <input class="admin-checkbox__input" type="checkbox" name="is_free"
                    {{ old('is_free') ? 'checked' : '' }}>
                <span class="admin-checkbox__icon"></span>
                <span>Бесплатный?</span>
            </label>
        </div>
        <div class="admin-form__flex">
            <div class="admin-label admin-form__flex_100">
                <span>Описание трека</span>
                <textarea class="summernote" name="description" id="description">{{ old('description') }}</textarea>
                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Изображение</span>
                <input class="admin-input" type="file" name="image" value="{{ old('image') }}"
                    accept="image/png, image/gif, image/jpeg">
                @error('image')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>seo title</span>
                <input class="admin-input" type="text" name="seo_title" value="{{ old('seo_title') }}">
                @error('seo_title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label admin-form__flex_long">
                <span>seo description</span>
                <textarea class="admin-input" type="text" name="seo_description" rows="1">{{ old('seo_description') }}</textarea>
                @error('seo_description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-button__margin-top">
            <button class="admin-button">Сохранить</button>
        </div>
    </form>
    <x-summernote_links></x-summernote_links>
@endsection
