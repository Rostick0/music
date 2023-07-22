@extends('layout.admin.index')

@section('html')
    <a class="admin-button admin-button-add" href="{{ route('component.create') }}">
        <span>Добавить</span>
        <span class="admin-button-add__plus">+</span>
    </a>
    <form class="admin-filter" action="{{ url()->current() }}">
        <div class="admin-filter__inputs">
            <input class="admin-input" type="search" placeholder="Название" name="name" value={{ Request::get('name') }}>
        </div>
        <div class="admin-filter__buttons">
            <button class="admin-button admin-filter__button">Поиск</button>
            <a class="admin-button-red admin-filter__button" href="{{ url()->current() }}">Сброс</a>
        </div>
    </form>
    <div class="admin-grid">
        <div class="admin-grid__titles admin-grid-component__titles">
            <div>ID</div>
            <div>Название</div>
            <div>Дата</div>
        </div>
        <ul class="admin-grid__content admin-grid-component__content">
            @foreach ($components as $component)
                <li class="admin-grid__content_item admin-grid-component__content_item">
                    <a
                        href="{{ route('component.edit', [
                            'id' => $component->id,
                        ]) }}">{{ $component->id }}</a>
                    <div>{{ $component->name }}</div>
                    <div>{{ $component->created_at }}</div>
                </li>
            @endforeach
        </ul>
        {{ $components->links('vendor.admin-pagination') }}
    </div>
@endsection
