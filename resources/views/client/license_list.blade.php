@extends('layout.client.index')

@section('html')
    <div class="">
        <form class="admin-filter" action="{{ url()->current() }}">
            <div class="admin-filter__inputs">
                <label class="admin-label">
                    <span>Уникальный код</span>
                    <input class="admin-input" type="search" name="code" value={{ Request::get('code') }}>
                </label>
                <label class="admin-label">
                    <span>Трек Id</span>
                    <input class="admin-input" type="search" name="licensesable_id"
                        value={{ Request::get('licensesable_id') }}>
                </label>
            </div>
            <div class="admin-filter__buttons">
                <button class="admin-button admin-filter__button">Поиск</button>
                <a class="admin-button-red admin-filter__button" href="{{ url()->current() }}">Сброс</a>
            </div>
        </form>
    </div>
    <div class="admin-grid">
        <div class="admin-grid__titles admin-grid-license__titles">
            <div>ID</div>
            <div>Название</div>
            <div>Код</div>
            <div>Почта пользователя</div>
            <div>Дата создание</div>
        </div>
        <ul class="admin-grid__content admin-grid-license__content">
            @foreach ($licenses as $license)
                <li class="admin-grid__content_item admin-grid-license__content_item">
                    <div>{{ $license->id }}</div>
                    <div>{{ $license?->licensesable?->title ?? '-' }}</div>
                    <div>{{ $license?->code }}</div>
                    <div>{{ $license?->user ? $license?->user?->email : '-' }}</div>
                    <div>{{ $license->created_at }}</div>
                    <a class="admin-button admin-button-edit"
                        href="{{ route('client.license.show', [
                            'id' => $license->id,
                        ]) }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <g data-name="32. Veiw" id="_32._Veiw" fill="#fff">
                                <path
                                    d="M23.909,11.582C21.943,7.311,17.5,3,12,3S2.057,7.311.091,11.582a1.008,1.008,0,0,0,0,.836C2.057,16.689,6.5,21,12,21s9.943-4.311,11.909-8.582A1.008,1.008,0,0,0,23.909,11.582ZM12,19c-4.411,0-8.146-3.552-9.89-7C3.854,8.552,7.589,5,12,5s8.146,3.552,9.89,7C20.146,15.448,16.411,19,12,19Z" />
                                <path d="M12,7a5,5,0,1,0,5,5A5.006,5.006,0,0,0,12,7Zm0,8a3,3,0,1,1,3-3A3,3,0,0,1,12,15Z" />
                            </g>
                        </svg>
                    </a>
                </li>
            @endforeach
        </ul>
        {{ $licenses->appends(Request::all())->links('vendor.admin-pagination') }}
    </div>
@endsection
