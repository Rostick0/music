@extends('layout.admin.index')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Название*</span>
                <input class="admin-input" type="text" name="name" maxlength="255"
                    value="{{ old('name') ?? $music_kit->name }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <div class="admin-label" tabindex="0">
                <span>Название музыки*</span>
                <div class="admin-select-async music-select-async">
                    <input class="admin-input admin-select-async__input" type="text" maxlength="255" name="music_name"
                        value="{{ old('music_name') ?? $music_kit->music_title }}" required>
                    <input class="admin-select-async__value" name="music_id"
                        value="{{ old('music_id') ?? $music_kit->music_id }}" required hidden>
                    <ul class="admin-select-async__list">
                        @foreach ($music_list as $music_item)
                            <li data-id="{{ $music_item->id }}" class="admin-select-async__item">{{ $music_item->title }},
                                {{ $music_item->artist->artist_name }}</li>
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
                <span>Трэк*</span>
                <input class="admin-input" type="file" name="link" accept=".mp3" value="{{ old('link') }}"
                    required>
                @error('link')
                    <span class="error">{{ $message }}</span>
                @enderror
                @if (App\Http\Controllers\MusicUploadController::check($music_kit->link, 'music_kit'))
                    <span>{{ App\Http\Controllers\MusicUploadController::getViewLink($music_kit->link, 'music_kit') }}</span>
                    <audio class="admin-audio" src="{{ Storage::url('upload/music_kit/' . $music_kit->link) }}"
                        controls></audio>
                @endif
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-checkbox">
                <input class="admin-checkbox__input" type="checkbox" name="is_active"
                    {{ old('is_active') ? 'checked' : '' }}>
                <span class="admin-checkbox__icon"></span>
                <span>Активен?</span>
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
@endsection
