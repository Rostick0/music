@extends('layout.admin.index')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="admin-form__gird playlist-grid">
            <label class="admin-label">
                <span>Name*</span>
                <input class="admin-input" type="text" name="title" maxlength="255" value="{{ old('title') }}" required>
                @error('title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label playlist-grid__description">
                <span>Description</span>
                <textarea class="admin-input flex-grow-1" type="text" name="description" rows="3">{{ old('description') }}</textarea>
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
                        <div class="admin-input">Mood</div>
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
                        <div class="admin-input">Theme</div>
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
                        <div class="admin-input">Instrument</div>
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
                <span>Active?</span>
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Seo title</span>
                <input class="admin-input" type="text" name="seo_title" value="{{ old('seo_title') }}">
                @error('seo_title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label admin-form__flex_long">
                <span>Seo description</span>
                <textarea class="admin-input" type="text" name="seo_description" rows="1">{{ old('seo_description') }}</textarea>
                @error('seo_description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-button__margin-top">
            <button class="admin-button">Save</button>
        </div>
    </form>
@endsection
