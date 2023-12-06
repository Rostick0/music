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
                    <span>Author*</span>
                    <input class="admin-input" type="text" name="music_artists" maxlength="255"
                        value="{{ old('music_artists') ?? $music_kit->artist->artist_name }}" required>
                    @error('music_artists')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="admin-label">
                    <span>Track name*</span>
                    <input class="admin-input" type="text" name="title" maxlength="255"
                        value="{{ old('title') ?? $music_kit->title }}" required>
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <div class="admin-form__flex">
                <label class="admin-label">
                    <span>Track*</span>
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
                        <span class="url">{{ App\Http\Controllers\MusicUploadController::getViewLink($music_kit->link, 'music_kit') }}</span>
                        <audio class="admin-audio"
                            src="{{ Storage::url('upload/music_kit/' . $music_kit->link, 'music_kit') }}" controls></audio>
                    @endif
                </label>
                <label class="admin-label">
                    <span>Demo track</span>
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
                        <span class="url">{{ App\Http\Controllers\MusicUploadController::getViewLink($music_kit->link_demo, 'music_kit_demo') }}</span>
                        <audio class="admin-audio"
                            src="{{ Storage::url('upload/music_kit_demo/' . $music_kit->link_demo) }}" controls></audio>
                    @endif
                </label>
                <label class="admin-label">
                    <span>Link to the publisher</span>
                    <input class="admin-input" type="text" name="publisher" maxlength="255"
                        value="{{ old('publisher') ?? $music_kit->publisher }}">
                    @error('publisher')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="admin-label">
                    <span>Link to the distributor</span>
                    <input class="admin-input" type="text" name="distr" maxlength="255"
                        value="{{ old('distr') ?? $music_kit->distr }}">
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
                            <div class="admin-input">Genre</div>
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
                    <span>Moods</span>
                    <details class="admin-details">
                        <summary class="admin-details__summary">
                            <div class="admin-input">Mood</div>
                        </summary>
                        <div class="admin-details__content">
                            @foreach ($moods as $mood)
                                <label class="admin-checkbox">
                                    <input class="admin-checkbox__input" type="checkbox" name="moods[]"
                                        @if (array_search($mood->id, Request::get('moods') ?? []) !== false || isset($mood->relationship_id)) checked @endif value="{{ $mood->id }}">
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
                            <div class="admin-input">Theme</div>
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
                </div>
                <label class="admin-label">
                    <span>Instruments</span>
                    <details class="admin-details">
                        <summary class="admin-details__summary">
                            <div class="admin-input">Instrument</div>
                        </summary>
                        <div class="admin-details__content">
                            @foreach ($instruments as $instrument)
                                <label class="admin-checkbox">
                                    <input class="admin-checkbox__input" type="checkbox" name="instruments[]"
                                        @if (array_search($instrument->id, Request::get('instruments') ?? []) !== false || isset($instrument->relationship_id)) checked @endif value="{{ $instrument->id }}">
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
                        {{ old('is_active') ?? $music_kit->is_active ? 'checked' : '' }}>
                    <span class="admin-checkbox__icon"></span>
                    <span>Аctive?</span>
                </label>
                <label class="admin-checkbox">
                    <input class="admin-checkbox__input" type="checkbox" name="is_free"
                        {{ old('is_free') ?? $music_kit->is_free ? 'checked' : '' }}>
                    <span class="admin-checkbox__icon"></span>
                    <span>Free?</span>
                </label>
            </div>
            <div class="admin-form__flex">
                <div class="admin-label admin-form__flex_100">
                    <span>Track description</span>
                    <textarea class="summernote" name="description" id="description">{{ old('description') ?? $music_kit->description }}</textarea>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="admin-form__flex">
                <label class="admin-label">
                    <span>Image</span>
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
            <div class="admin-delete__buttons admin-button__margin-top">
                <button class="admin-button">Save changes</button>
                <a class="admin-button-red"
                    href="{{ route('delete_confirm', [
                        'type' => 'music_kits',
                        'type_id' => $music_kit->id,
                    ]) }}">Remove</a>
            </div>
        </form>
        <div>
            <h2 class="admin-content__title">Parts of track</h2>
            <form class="admin-form" action="{{ route('part.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="admin-form__flex">
                    <input type="hidden" name="type" value="music_kit">
                    <input type="hidden" name="type_id" value="{{ $music_kit->id }}">
                    <label class="admin-label">
                        <span>Name</span>
                        <input class="admin-input" type="text" name="part_title" value="{{ old('part_title') }}"
                            maxlength="255" required>
                        @error('part_title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </label>
                    <label class="admin-label">
                        <span>Track*</span>
                        <span class="admin-file-upload">
                            <input class="admin-file-upload__input" type="file" name="part_link" accept=".mp3,.wav"
                                value="{{ old('part_link') }}" required>
                            <span class="admin-input">
                                <span class="admin-file-upload__name">Upload file</span>
                            </span>
                        </span>
                        @error('part_link')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div class="admin-delete__buttons">
                    <button class="admin-button">Add</button>
                </div>
            </form>
        </div>
        <div class="admin-form">
            @foreach ($music_kit->parts as $part)
                <div class="admin-form__flex aling-items-end">
                    <label class="admin-label">
                        <span>Name</span>
                        <input class="admin-input" type="text" value="{{ $part->title }}" disabled>
                    </label>
                    <label class="admin-label">
                        <span>File</span>
                        <input class="admin-input" type="text" value="{{ $part->link }}" disabled>
                        <audio src=""></audio>
                    </label>
                    <div class="admin-buttons">
                        <a class="admin-button" href="{{ route('part.edit', ['id' => $part->id]) }}">Изменить</a>
                        <form action="{{ route('part.delete', ['id' => $part->id]) }}" method="post">
                            @csrf
                            <button class="admin-button-red">Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <x-summernote_links></x-summernote_links>
@endsection
