@extends('layout.admin.index')

@section('html')
    <form class="admin-filter" action="{{ url()->current() }}">
        <div class="admin-filter__inputs">
            {{-- {{ dd(Request::get('subscription_types')) }} --}}
            <input class="admin-input" type="search" placeholder="Название" name="name" value="{{ Request::get('name') }}">
            <input class="admin-input" type="number" step="0.01" placeholder="Цена от" name="name"
                value="{{ Request::get('price_min') }}">
            <input class="admin-input" type="number" step="0.01" placeholder="Цена от" name="name"
                value="{{ Request::get('price_max') }}">
        </div>
        <div class="admin-filter__buttons">
            <button class="admin-button admin-filter__button">Поиск</button>
            <a class="admin-button-red admin-filter__button" href="{{ url()->current() }}">Сброс</a>
        </div>
    </form>
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
                    <a
                        href="{{ route('subscription_type.edit', [
                            'id' => $subscription_type->id,
                        ]) }}">{{ $subscription_type->id }}</a>
                    <div>{{ $subscription_type->name }}</div>
                    <div>{{ $subscription_type->price }}</div>
                    <div>{{ $subscription_type->is_active ? 'Да' : 'Нет' }}</div>
                    <div>{{ $subscription_type->created_at }}</div>
                </li>
            @endforeach
        </ul>
        {{ $subscription_types->links('vendor.admin-pagination') }}
    </div>
@endsection
