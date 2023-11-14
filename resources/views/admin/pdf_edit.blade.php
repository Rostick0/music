@extends('layout.admin.index')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="admin-form__flex">
            <div class="admin-label admin-form__flex_long admin-form__flex_100">
                <span>Контент страницы</span>
                <textarea class="summernote" name="content" id="content">{!! old('content') ?? $content !!}</textarea>
                @error('content')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="admin-delete__buttons admin-button__margin-top">
            <button class="admin-button admin-delete__button">Сохранить</button>
        </div>
    </form>
    <style>
        .admin-delete__buttons {
            display: flex;
            column-gap: 10px;
        }

        .admin-delete__button {
            font-size: 16px;
        }
    </style>
    <x-summernote_links></x-summernote_links>
@endsection
