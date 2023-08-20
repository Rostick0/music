@extends('layout.admin.index')

@section('html')
    @vite(['resources/scss/front/index.scss'])
    <form class="admin-form" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Название*</span>
                <input class="admin-input" type="text" name="name" maxlength="255" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Путь*</span>
                <input class="admin-input" type="text" name="path" maxlength="255" value="{{ old('path') }}"
                    required>
                @error('path')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <div class="admin-label admin-form__flex_long admin-form__flex_100">
                <span>Код компонента</span>
                <textarea class="summernote" name="content" id="content">{{ old('content') }}</textarea>
                @error('content')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="admin-button__margin-top">
            <button class="admin-button">Сохранить</button>
        </div>
    </form>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script type="text/javascript" defer>
        $('.summernote').summernote({
            height: 500
        });
    </script>
    @vite(['resources/js/front.js'])
@endsection
