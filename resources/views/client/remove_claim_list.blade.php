@extends('layout.client.index')

@section('html')
    {{-- <form class="admin-filter" action="{{ url()->current() }}">
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
    </form> --}}
    <div class="admin-grid">
        <div class="admin-grid__titles admin-grid-remove-claim-client__titles">
            <div>ID</div>
            <div>Музыка</div>
            <div>Ссылка</div>
            <div>Статус</div>
            <div>Дата</div>
        </div>
        <ul class="admin-grid__content admin-grid-remove-claim-client__content">
            @foreach ($remove_claims as $remove_claim)
                <li class="admin-grid__content_item admin-grid-remove-claim-client__content_item">
                    <div>{{ $remove_claim->id }}</div>
                    <div class="text-ellipsis">
                        {{ $remove_claim->music->title . ', ' . $remove_claim->music->artist->artist_name }}</div>
                    <a class="text-ellipsis" title="{{ $remove_claim->link }}" target="_blank"
                        href="{{ $remove_claim->link }}">{{ $remove_claim->link }}</a>
                    <div>{{ $remove_claim->status }}</div>
                    <div>{{ $remove_claim->created_at }}</div>
                </li>
            @endforeach
        </ul>
        {{ $remove_claims->links('vendor.admin-pagination') }}
    </div>
@endsection
