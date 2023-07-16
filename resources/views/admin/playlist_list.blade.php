@extends('layout.admin.index')

@section('html')
    <a class="admin-button admin-button-add" href="{{ route('playlist.create') }}">
        <span>Добавить</span>
        <span class="admin-button-add__plus">+</span>
    </a>
    <form class="admin-filter" action="{{ url()->current() }}">
        <div class="admin-filter__inputs">
            <input class="admin-input" type="search" placeholder="Название" name="title" value={{ Request::get('title') }}>
            <select class="admin-input" name="genres_id">
                <option value="" hidden>Жанр</option>
                @foreach ($genres as $genre)
                    <option {{ $genre->id == old('genres_id') ? 'selected' : '' }} value="{{ $genre->id }}">
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
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
        <div class="admin-filter__buttons">
            <button class="admin-button admin-filter__button">Поиск</button>
            <a class="admin-button-red admin-filter__button" href="{{ url()->current() }}">Сброс</a>
        </div>
    </form>
    <div class="admin-grid">
        <div class="admin-grid__titles admin-grid-playlist__titles">
            <div>ID</div>
            <div>Название</div>
            <div>Ссылка</div>
            <div>Жанр</div>
            <div>Активен?</div>
            <div>Дата</div>
        </div>
        <ul class="admin-grid__content admin-grid-playlist__content">
            @foreach ($playlists as $playlist)
                <li class="admin-grid__content_item admin-grid-playlist__content_item">
                    <a href="{{ route('playlist.edit', ['id' => $playlist->id]) }}">{{ $playlist->id }}</a>
                    <div>{{ $playlist->title }}</div>
                    <div>{{ $playlist->genre_name }}</div>
                    <div>{{ $playlist->is_active ? 'Да' : 'Нет' }}</div>
                    <div>{{ $playlist->created_at }}</div>
                </li>
            @endforeach
        </ul>
        {{ $playlists->links('vendor.admin-pagination') }}
    </div>
@endsection
