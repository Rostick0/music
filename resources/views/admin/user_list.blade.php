@extends('layout.admin')

@section('html')
    <form class="admin-filter" action="{{ url()->current() }}">
        <div class="admin-filter__inputs">
            <input class="admin-input" type="search" placeholder="Имя" name="name" value="{{ Request::get('name') }}">
            <input class="admin-input" type="search" placeholder="Фамилия" name="surname"
                value="{{ Request::get('surname') }}">
            <input class="admin-input" type="search" placeholder="E-mail" name="email"
                value="{{ Request::get('email') }}">
        </div>
        <div class="admin-filter__buttons">
            <button class="admin-button admin-filter__button">Поиск</button>
            <a class="admin-button-red admin-filter__button" href="{{ url()->current() }}">Сброс</a>
        </div>
    </form>
    <div class="admin-grid">
        <div class="admin-grid__titles admin-grid-user__titles">
            <div>ID</div>
            <div>Имя</div>
            <div>Фамилия</div>
            <div>Ник</div>
            <div>Email</div>
            <div>Телефон</div>
            <div>Дата</div>
        </div>
        <ul class="admin-grid__content admin-grid-user__content">
            @foreach ($users as $user)
                <li class="admin-grid__content_item admin-grid-user__content_item">
                    <a href="{{ route('user.edit', ['id' => $user->id]) }}">{{ $user->id }}</a>
                    <div>{{ $user->name }}</div>
                    <div>{{ $user->surname }}</div>
                    <div>{{ $user->nickname }}</div>
                    <div>{{ $user->email }}</div>
                    <div>{{ $user->telephone ?? '-' }}</div>
                    <div>{{ $user->created_at }}</div>
                </li>
            @endforeach
        </ul>
        {{ $users->links('vendor.admin-pagination') }}
    </div>
@endsection
