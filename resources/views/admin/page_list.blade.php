@extends('layout.admin')

@section('html')
    <form class="admin-filter" action="{{ url()->current() }}">
        <div class="admin-filter__inputs">
            <input class="admin-input" type="search" placeholder="Название" name="name" value={{ Request::get('name') }}>
            <input class="admin-input" type="search" placeholder="Ссылка (Без http и домена)" name="url"
                value={{ Request::get('url') }}>
        </div>
        <div class="admin-filter__buttons">
            <button class="admin-button admin-filter__button">Поиск</button>
            <a class="admin-button-red admin-filter__button" href="{{ url()->current() }}">Сброс</a>
        </div>
    </form>
    <div class="admin-grid">
        <div class="admin-grid__titles admin-grid-page__titles">
            <div>ID</div>
            <div>Название</div>
            <div>Ссылка</div>
            <div>Дата</div>
        </div>
        <ul class="admin-grid__content admin-grid-page__content">
            @foreach ($pages as $page)
                <li class="admin-grid__content_item admin-grid-page__content_item">
                    <a
                        href="{{ route('page.edit', [
                            'id' => $page->id,
                        ]) }}">{{ $page->id }}</a>
                    <div>{{ $page->name }}</div>
                    <a target="_blank" href="{{ url($page->url) }}">{{ url($page->url) }}</a>
                    <div>{{ $page->created_at }}</div>
                </li>
            @endforeach
        </ul>
        {{ $pages->links('vendor.admin-pagination') }}
    </div>
@endsection
