@extends('layout.admin')

@section('html')
    <form class="admin-filter" action="{{ url()->current() }}">
        <div class="admin-filter__inputs">
            <details class="admin-details">
                <summary class="admin-details__summary">
                    <div class="admin-input">Тип подписки</div>
                </summary>
                <div class="admin-details__content">
                    @foreach ($subscription_types as $subscription_type)
                        <label class="admin-checkbox">
                            <input class="admin-checkbox__input" type="checkbox" name="subscription_types[]"
                                @if (array_search($subscription_type->id, Request::get('subscription_types') ?? []) !== false) checked @endif value="{{ $subscription_type->id }}">
                            <span class="admin-checkbox__icon"></span>
                            <span>{{ $subscription_type->name }}</span>
                        </label>
                    @endforeach
                </div>
            </details>
            {{-- {{ dd(Request::get('subscription_types')) }} --}}
            <input class="admin-input" type="search" placeholder="E-mail" name="email"
                value="{{ Request::get('email') }}">
        </div>
        <div class="admin-filter__buttons">
            <button class="admin-button admin-filter__button">Поиск</button>
            <a class="admin-button-red admin-filter__button" href="{{ url()->current() }}">Сброс</a>
        </div>
    </form>
    <div class="admin-grid">
        <div class="admin-grid__titles admin-grid-subscription__titles">
            <div>ID</div>
            <div>Тип</div>
            <div>Email</div>
            <div>Автопродление</div>
            <div>Дата начала</div>
            <div>Дата Окончания</div>
        </div>
        <ul class="admin-grid__content admin-grid-subscription__content">
            @foreach ($subscriptions as $subscription)
                <li class="admin-grid__content_item admin-grid-subscription__content_item">
                    <div>{{ $subscription->id }}</div>
                    <div>{{ $subscription->subscription_name }}</div>
                    <a href={{ route('user.edit', ['id' => $subscription->users_id]) }}>{{ $subscription->user_email }}</a>
                    <div>{{ $subscription->is_auto_renewal ? 'Да' : 'Нет' }}</div>
                    <div>{{ $subscription->created_at }}</div>
                    <div>{{ $subscription->date_end }}</div>
                </li>
            @endforeach
        </ul>
        {{ $subscriptions->links('vendor.admin-pagination') }}
    </div>
@endsection
