@extends('layout.admin.index')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Вопрос*</span>
                <input class="admin-input" type="text" name="question" maxlength="255"
                    value="{{ old('question') ?? $faq->question }}" required>
                @error('question')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label admin-form__flex_long">
                <span>Ответ*</span>
                <textarea class="admin-input" type="text" name="answer" rows="1" required>{{ old('answer') ?? $faq->answer }}</textarea>
                @error('answer')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-buttons">
            <button class="admin-button">Изменить</button>
        </div>
        @if (Session::has('success'))
            <div class="feedback__success success">{{ Session::get('success') }}</div>
            <meta http-equiv="refresh" content="2; url={{route('settings')}}">
        @endif
    </form>
@endsection
