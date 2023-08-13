@extends('layout.admin.index')

@section('html')
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
        </div>
        <div class="admin-buttons">
            <button class="admin-button">Сохранить</button>
        </div>
    </form>
    <br>
    <h2>Меню</h2>
    <div class="admin-form">
        @foreach ($genre_list as $genre_item)
            <div class="admin-form__flex aling-items-end">
                <label class="admin-label">
                    <span>Название*</span>
                    <input class="admin-input" type="text" value="{{ $genre_item->name }}" disabled required>
                </label>
                <div class="admin-buttons">
                    <a class="admin-button"
                        href="{{ route('genre.edit', [
                            'id' => $genre_item->id,
                        ]) }}">Изменить</a>
                    <a class="admin-button-red admin-delete__button"
                        href="{{ route('delete_confirm', [
                            'type' => 'genres',
                            'type_id' => $genre_item->id,
                        ]) }}">Удалить</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
