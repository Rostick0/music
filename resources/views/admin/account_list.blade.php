@extends('layout.admin.index')

@section('html')
    <div class="">
        <form class="admin-filter" action="{{ url()->current() }}">
            <div class="admin-filter__inputs">
                <input class="admin-input" type="search" placeholder="E-mail" name="email"
                    value={{ Request::get('email') }}>
            </div>
            <div class="admin-filter__buttons">
                <button class="admin-button admin-filter__button">Поиск</button>
                <a class="admin-button-red admin-filter__button" href="{{ url()->current() }}">Сброс</a>
            </div>
        </form>
    </div>
    <div class="admin-grid">
        <div class="admin-grid__titles admin-grid-account__titles">
            <div>ID</div>
            <div>E-mail</div>
            <div>Аккаунт url</div>
            <div>Дата создание</div>
        </div>
        <ul class="admin-grid__content admin-grid-account__content">
            @foreach ($accounts as $account)
                <li class="admin-grid__content_item admin-grid-account__content_item">
                    <div>{{ $account->id }}</div>
                    <div>{{ $account->user->email }}</div>
                    <div>{{ $account->url }}</div>
                    <div>{{ $account->created_at }}</div>
                </li>
            @endforeach
        </ul>
        {{ $accounts->appends(Request::all())->links('vendor.admin-pagination') }}
    </div>
@endsection
