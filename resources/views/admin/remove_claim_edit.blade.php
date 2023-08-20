@extends('layout.admin.index')

@section('html')
    <div class="admin-form__flex">
        <div class="admin-label">
            <span>Ссылка*</span>
            <a href="{{ $remove_claim->link }}">{{ $remove_claim->link }}</a>
        </div>
        <div class="admin-label">
            <span>Музыка*</span>
            <a href="{{ $remove_claim->music_id }}">{{ $remove_claim->music->title }}</a>
        </div>
        <div class="admin-label">
            <span>Пользователь*</span>
            <a href="{{ $remove_claim->user_id }}">{{ $remove_claim->user->email }}</a>
        </div>
    </div>

    <br>
    <form class="admin-form" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Статус*</span>
                <select class="admin-input" name="status" required>
                    <option value="" hidden>Выберите</option>
                    @foreach ($status as $status_item)
                        <option @if ((old('status_item') ?? $status_item) == $remove_claim->status) selected @endif value="{{ $status_item }}">
                            {{ $status_item }}</option>
                    @endforeach
                </select>
                @error('status')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-buttons admin-button__margin-top">
            <button class="admin-button">Изменить</button>
        </div>
    </form>
@endsection
