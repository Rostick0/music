@extends('layout.admin')

@section('html')
    <a class="admin-button admin-button-add" href="{{ route('music.create') }}">
        <span>Добавить</span>
        <span class="admin-button-add__plus">+</span>
    </a>
    <form class="admin-filter" action="{{ url()->current() }}">
        <div class="admin-filter__inputs">
            <label class="admin-label w-100">
                <span>Название</span>
                <input class="admin-input" type="search" placeholder="Название" name="music_artists"
                    value={{ Request::get('music_artists') }}>
            </label>
            <label class="admin-label w-100">
                <span>Автор</span>
                <input class="admin-input" type="search" placeholder="Автор" name="artists"
                    value={{ Request::get('artists') }}>
            </label>
            <label class="admin-label w-100">
                <span>Жанр</span>
                <select class="admin-input" name="genres_id">
                    <option value="" hidden>Жанр</option>
                    @foreach ($genres as $genre)
                        <option {{ $genre->id == old('genres_id') ? 'selected' : '' }} value="{{ $genre->id }}">
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </label>
            <div class="admin-label w-100">
                <span>Тема</span>
                <details class="admin-details">
                    <summary class="admin-details__summary">
                        <div class="admin-input">Тема</div>
                    </summary>
                    <div class="admin-details__content">
                        @foreach ($themes as $theme)
                            <label class="admin-checkbox">
                                <input class="admin-checkbox__input" type="checkbox" name="themes[]"
                                    @if (array_search($theme->id, Request::get('themes') ?? []) !== false) checked @endif value="{{ $theme->id }}">
                                <span class="admin-checkbox__icon"></span>
                                <span>{{ $theme->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </details>
            </div>
            <div class="admin-label w-100">
                <span>Инструменты</span>
                <details class="admin-details">
                    <summary class="admin-details__summary">
                        <div class="admin-input">Инструменты</div>
                    </summary>
                    <div class="admin-details__content">
                        @foreach ($instruments as $instrument)
                            <label class="admin-checkbox">
                                <input class="admin-checkbox__input" type="checkbox" name="instruments[]"
                                    @if (array_search($instrument->id, Request::get('instruments') ?? []) !== false) checked @endif value="{{ $instrument->id }}">
                                <span class="admin-checkbox__icon"></span>
                                <span>{{ $instrument->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </details>
            </div>
            <div class="admin-label w-100">
                <span>Настроение</span>
                <details class="admin-details">
                    <summary class="admin-details__summary">
                        <div class="admin-input">Настроение</div>
                    </summary>
                    <div class="admin-details__content">
                        @foreach ($moods as $mood)
                            <label class="admin-checkbox">
                                <input class="admin-checkbox__input" type="checkbox" name="moods[]"
                                    @if (array_search($mood->id, Request::get('moods') ?? []) !== false) checked @endif value="{{ $mood->id }}">
                                <span class="admin-checkbox__icon"></span>
                                <span>{{ $mood->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </details>
            </div>
            <label class="admin-label w-100">
                <span>Минимальное время</span>
                <input class="admin-input" type="time" name="min_time" value={{ Request::get('min_time') }}>
            </label>
            <label class="admin-label w-100">
                <span>Максимальное время</span>
                <input class="admin-input" type="time" name="max_time" value={{ Request::get('max_time') }}>
            </label>
        </div>
        <div class="admin-filter__buttons">
            <button class="admin-button admin-filter__button">Поиск</button>
            <a class="admin-button-red admin-filter__button" href="{{ url()->current() }}">Сброс</a>
        </div>
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
