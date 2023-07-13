@extends('layout.admin')

@section('html')
    <form class="admin-filter" action="{{ url()->current() }}">
        <div class="admin-filter__inputs">
            <label class="admin-label w-100">
                <span>Название</span>
                <input class="admin-input" type="search" placeholder="Название" name="name"
                    value={{ Request::get('name') }}>
            </label>
            <label class="admin-label w-100">
                <span>Ссылка</span>
                <input class="admin-input" type="search" placeholder="Ссылка" name="link"
                    value={{ Request::get('link') }}>
            </label>
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
        <div class="admin-grid__titles admin-grid-music-kit__titles">
            <div>ID</div>
            <div>Название</div>
            <div>Ссылка</div>
            <div>Длительность</div>
            <div>Активен</div>
            <div>Дата</div>
        </div>
        <ul class="admin-grid__content admin-grid-music-kit__content">
            @foreach ($music_kits as $music_kit)
                <li class="admin-grid__content_item admin-grid-music-kit__content_item">
                    <a href="{{ route('music_kit.edit', ['id' => $music_kit->id]) }}">{{ $music_kit->id }}</a>
                    <div>{{ $music_kit->name }}</div>
                    <a class="text-ellipsis" title="{{ $music_kit->link }}" target="_blank"
                        href="{{ $music_kit->link }}">{{ $music_kit->link }}</a>
                    <div>{{ $music_kit->duration }}</div>
                    <div>{{ $music_kit->is_active ? 'Да' : 'Нет' }}</div>
                    <div>{{ $music_kit->created_at }}</div>
                </li>
            @endforeach
        </ul>
        {{ $music_kits->links('vendor.admin-pagination') }}
    </div>
@endsection
