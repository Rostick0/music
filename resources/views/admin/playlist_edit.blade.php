@extends('layout.admin.index')

@section('html')
    <div class="admin-content__inner_gap">
        <form class="admin-form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="admin-form__gird playlist-grid">
                <label class="admin-label">
                    <span>Name*</span>
                    <input class="admin-input" type="text" name="title" maxlength="255"
                        value="{{ old('title') ?? $playlist->title }}" required>
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="admin-label playlist-grid__description">
                    <span>Description</span>
                    <textarea class="admin-input flex-grow-1" type="text" name="description" rows="3">{{ old('description') ?? $playlist->description }}</textarea>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="admin-label">
                    <span>Image</span>
                    <input class="admin-input" type="file" name="image" value="{{ old('image') }}"
                        accept="image/png, image/gif, image/jpeg">
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
                <label class="admin-label">
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
                </label>
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
                        {{ old('is_active') ?? $playlist->is_active ? 'checked' : '' }}>
                    <span class="admin-checkbox__icon"></span>
                    <span>Active?</span>
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
            <div class="admin-delete__buttons admin-button__margin-top">
                <button class="admin-button">Save</button>
                <a class="admin-button-red"
                    href="{{ route('delete_confirm', [
                        'type' => 'playlists',
                        'type_id' => $playlist->id,
                    ]) }}">Remove</a>
            </div>
        </form>
        <div class="admin-form__flex">
            <a class="admin-button admin-button-add-form"
                href="{{ route('playlist.music.list', ['playlist_id' => $playlist->id]) }}">
                <span class="admin-button-add__plus">+</span>
                <span>Add to playlist</span>
            </a>
        </div>
        <div>
            <h2 class="admin-content__title">Track list</h2>
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
        </div>
    </div>
@endsection
