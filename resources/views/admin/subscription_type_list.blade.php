@extends('layout.admin.index')

@section('html')
    <div class="">
        <a class="admin-button admin-button-add" href="{{ route('subscription_type.create') }}">
            <span>Добавить</span>
            <span class="admin-button-add__plus">+</span>
        </a>
        <form class="admin-filter" action="{{ url()->current() }}">
            <div class="admin-filter__inputs">
                <input class="admin-input" type="search" placeholder="Название" name="name"
                    value="{{ Request::get('name') }}">
                <input class="admin-input" type="number" step="0.01" placeholder="Цена от" name="price_min"
                    value="{{ Request::get('price_min') }}">
                <input class="admin-input" type="number" step="0.01" placeholder="Цена до" name="price_max"
                    value="{{ Request::get('price_max') }}">
            </div>
            <div class="admin-filter__buttons">
                <button class="admin-button admin-filter__button">Поиск</button>
                <a class="admin-button-red admin-filter__button" href="{{ url()->current() }}">Сброс</a>
            </div>
        </form>
    </div>
    <div class="admin-grid">
        <div class="admin-grid__titles admin-grid-subscription_type__titles">
            <div>ID</div>
            <div>Название</div>
            <div>Цена</div>
            <div>Активна</div>
            <div>Дата начала</div>
        </div>
        <ul class="admin-grid__content admin-grid-subscription_type__content">
            @foreach ($subscription_types as $subscription_type)
                <li class="admin-grid__content_item admin-grid-subscription_type__content_item">
                    <div>{{ $subscription_type->id }}</div>
                    <div>{{ $subscription_type->name }}</div>
                    <div>{{ $subscription_type->price }}</div>
                    <div>{{ $subscription_type->is_active ? 'Да' : 'Нет' }}</div>
                    <div>{{ $subscription_type->created_at }}</div>
                    <a class="admin-button admin-button-edit" href="{{ route('subscription_type.edit', ['id' => $subscription_type->id]) }}">
                        <svg width="16" height="16" fill="#fff" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 32 32">
                            <path
                                d="M 23.90625 3.96875 C 22.859286 3.96875 21.813178 4.3743215 21 5.1875 L 5.40625 20.78125 L 5.1875 21 L 5.125 21.3125 L 4.03125 26.8125 L 3.71875 28.28125 L 5.1875 27.96875 L 10.6875 26.875 L 11 26.8125 L 11.21875 26.59375 L 26.8125 11 C 28.438857 9.373643 28.438857 6.813857 26.8125 5.1875 C 25.999322 4.3743215 24.953214 3.96875 23.90625 3.96875 z M 23.90625 5.875 C 24.409286 5.875 24.919428 6.1069285 25.40625 6.59375 C 26.379893 7.567393 26.379893 8.620107 25.40625 9.59375 L 24.6875 10.28125 L 21.71875 7.3125 L 22.40625 6.59375 C 22.893072 6.1069285 23.403214 5.875 23.90625 5.875 z M 20.3125 8.71875 L 23.28125 11.6875 L 11.1875 23.78125 C 10.533142 22.500659 9.4993415 21.466858 8.21875 20.8125 L 20.3125 8.71875 z M 6.9375 22.4375 C 8.1365842 22.923393 9.0766067 23.863416 9.5625 25.0625 L 6.28125 25.71875 L 6.9375 22.4375 z" />
                        </svg>
                    </a>
                </li>
            @endforeach
        </ul>
        {{ $subscription_types->appends(Request::all())->links('vendor.admin-pagination') }}
    </div>
@endsection
