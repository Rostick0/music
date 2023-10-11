@extends('layout.client.index')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post">
        @csrf
        <label class="admin-label w-100">
            <span>Ссылка на канал*</span>
            <input class="admin-input" type="text" name="url" maxlength="255" value="{{ old('url') ?? $account?->url }}"
                required>
            @error('url')
                <span class="error">{{ $message }}</span>
            @enderror
        </label>
        <div class="admin-delete__buttons">
            <button class="admin-button">Изменить</button>
        </div>
    </form>
@endsection
