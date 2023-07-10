@extends('layout.admin')

@section('html')
    <form class="admin-filter" action="{{ url()->current() }}">
        <div class="admin-filter__inputs">
            <input class="admin-input" type="search" placeholder="Название" name="title">
            <select class="admin-input" name="genres_id">
                <option value="" hidden>Жанр</option>
                @foreach ($genres as $genre)
                    <option {{ $genre->id == old('genres_id') ? 'selected' : '' }} value="{{ $genre->id }}">
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
            <input class="admin-input" type="search" placeholder="Тема">
            <input class="admin-input" type="search" placeholder="Инструменты">
            <input class="admin-input" type="search" placeholder="Настроение">
        </div>
        <button class="admin-button admin-filter__button">Поиск</button>
    </form>
    <div class="admin-grid">
        <div class="admin-grid__titles admin-grid-music__titles">
            <div>ID</div>
            <div>Название</div>
            <div>Ссылка</div>
            <div>Автор</div>
            <div>Жанр</div>
            <div>Длительность</div>
            <div>Активен?</div>
            <div>Бесплатен?</div>
            <div>Дата</div>
        </div>
        <ul class="admin-grid__content admin-grid-music__content">
            @foreach ($music_list as $music_item)
                <li class="admin-grid__content_item admin-grid-music__content_item">
                    <a href="{{ route('music.edit', ['id' => $music_item->id]) }}">{{ $music_item->id }}</a>
                    <div>{{ $music_item->title }}</div>
                    <a class="text-ellipsis" title="{{ $music_item->link }}" target="_blank"
                        href="{{ $music_item->link }}">{{ $music_item->link }}</a>
                    <div>{{ $music_item->music_artist_name }}</div>
                    <div>{{ $music_item->genre_name }}</div>
                    <div>{{ $music_item->duration }}</div>
                    <div>{{ $music_item->is_active ? 'Да' : 'Нет' }}</div>
                    <div>{{ $music_item->is_free ? 'Да' : 'Нет' }}</div>
                    <div>{{ $music_item->created_at }}</div>
                </li>
            @endforeach
        </ul>
        {{ $music_list->links('vendor.admin-pagination') }}
    </div>
@endsection
