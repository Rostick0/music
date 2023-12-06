@extends('layout.admin.index')

@php
    $check_link = App\Http\Controllers\MusicUploadController::check($music_part->link, 'part');
@endphp

@section('html')
    <div class="admin-content__inner_gap">
        <form class="admin-form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="admin-form__flex">
                <label class="admin-label">
                    <span>Name*</span>
                    <input class="admin-input" type="text" name="title" maxlength="255"
                        value="{{ old('title') ?? $music_part->title }}" required>
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
                        <span>{{ App\Http\Controllers\MusicUploadController::getViewLink($music_part->link, 'part') }}</span>
                        <audio class="admin-audio" src="{{ Storage::url('upload/part/' . $music_part->link) }}"
                            controls></audio>
                    @endif
                </label>
            </div>
            @if (Session::has('success'))
                <div class="feedback__success success">{{ Session::get('success') }}</div>
                @if ($music_part->type == 'music')
                    <meta http-equiv="refresh" content="1; url={{ route('music.edit', ['id' => $music_part->type_id]) }}">
                @else
                    <meta http-equiv="refresh" content="1; url={{ route('music_kit.edit', ['id' => $music_part->type_id]) }}">
                @endif
            @endif
            <div class="admin-delete__buttons admin-button__margin-top">
                <button class="admin-button">Save changes</button>
            </div>
        </form>
    </div>
@endsection
