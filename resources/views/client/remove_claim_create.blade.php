@extends('layout.client.index')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="admin-form__flex">
            <div class="admin-label" tabindex="0">
                <span>Name music*</span>
                <div class="admin-select-async music-select-async">
                    <input class="admin-input admin-select-async__input" type="text" name="music_name"
                        placeholder="Name music" required>
                    <input class="admin-select-async__value" name="music_id" value="{{ old('music_id') }}" required hidden>
                    <ul class="admin-select-async__list">
                        @foreach ($music_list as $music_item)
                            <li data-id="{{ $music_item->id }}" class="admin-select-async__item">{{ $music_item->title . ', ' . $music_item->artist->artist_name }}</li>
                        @endforeach
                    </ul>
                </div>
                @error('music_id')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <label class="admin-label">
                    <span>Link*</span>
                    <input class="admin-input" type="text" name="link" value="{{ old('link') }}" maxlength="255"
                        required>
                    @error('link')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
            </label>
        </div>
        <div>
            <button class="admin-button">Send</button>
        </div>
    </form>
@endsection
