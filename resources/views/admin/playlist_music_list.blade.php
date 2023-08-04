@extends('layout.admin.index')

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
            <div class="admin-label w-100">
                <span>Тема</span>
                <details class="admin-details">
                    <summary class="admin-details__summary">
                        <div class="admin-input">Тема</div>
                    </summary>
                    <div class="admin-details__content">
                        @foreach ($genres as $genre)
                            <label class="admin-checkbox">
                                <input class="admin-checkbox__input" type="checkbox" name="genres[]"
                                    @if (array_search($genre->id, Request::get('genres') ?? []) !== false) checked @endif value="{{ $genre->id }}">
                                <span class="admin-checkbox__icon"></span>
                                <span>{{ $genre->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </details>
            </div>
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
                    <div>{{ $music_item->id }}</div>
                    <div>{{ $music_item->title }}</div>
                    <a class="text-ellipsis" title="{{ $music_item->link }}" target="_blank"
                        href="{{ $music_item->link }}">{{ $music_item->link }}</a>
                    <div>{{ $music_item->music_artist_name }}</div>
                    <div>{{ $music_item->genre_name }}</div>
                    <div>{{ $music_item->duration }}</div>
                    <div>{{ $music_item->is_active ? 'Да' : 'Нет' }}</div>
                    <div>{{ $music_item->is_free ? 'Да' : 'Нет' }}</div>
                    <div>{{ $music_item->created_at }}</div>
                    <form
                        action="{{ route('playlist.music.add', [
                            'music_id' => $music_item->id,
                            'playlist_id' => $id,
                        ]) }}"
                        method="post">
                        @csrf
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="16" height="16">
                                <path
                                    d="M 25 2 C 12.309295 2 2 12.309295 2 25 C 2 37.690705 12.309295 48 25 48 C 37.690705 48 48 37.690705 48 25 C 48 12.309295 37.690705 2 25 2 z M 25 4 C 36.609824 4 46 13.390176 46 25 C 46 36.609824 36.609824 46 25 46 C 13.390176 46 4 36.609824 4 25 C 4 13.390176 13.390176 4 25 4 z M 24 13 L 24 24 L 13 24 L 13 26 L 24 26 L 24 37 L 26 37 L 26 26 L 37 26 L 37 24 L 26 24 L 26 13 L 24 13 z" />
                            </svg>
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
        {{ $music_list->links('vendor.admin-pagination') }}
    </div>
@endsection
