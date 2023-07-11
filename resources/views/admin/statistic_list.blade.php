@extends('layout.admin')

@section('html')
    <form class="admin-filter" action="{{ url()->current() }}">
        <div class="admin-filter__inputs">
            <input class="admin-input" type="search" placeholder="Имя" name="name">
            <input class="admin-input" type="search" placeholder="Фамилия" name="surname">
            <input class="admin-input" type="search" placeholder="E-mail" name="email">
        </div>
        <div class="admin-filter__buttons">
            <button class="admin-button admin-filter__button">Поиск</button>
            <a class="admin-button-red admin-filter__button" href="{{ url()->current() }}">Сброс</a>
        </div>
    </form>
    <div class="admin-grid">
        <div class="admin-grid__titles admin-grid-statistic__titles">
            <div>ID</div>
            <div>Тип</div>
            <div>Email</div>
            <div>Дата</div>
        </div>
        <ul class="admin-grid__content admin-grid-statistic__content">
            @foreach ($statistics as $statistic)
                <li class="admin-grid__content_item admin-grid-statistic__content_item">
                    <div>{{ $statistic->id }}</div>
                    @if ($statistic->type == 'subscription')
                        <div>{{ $statistic->type }}
                            {{-- ({{ $statistic->type_paid ?? '' }}) --}}
                        </div>
                    @elseif ($statistic->type == 'download')
                        <a href={{ route('music.edit', ['id' => $statistic->music_id]) }}>{{ $statistic->type }}
                            ({{ $statistic->music_title }})
                        </a>
                    @else
                        <div>{{ $statistic->type }}</div>
                    @endif
                    <a href={{ route('user.edit', ['id' => $statistic->users_id]) }}>{{ $statistic->user_email }}</a>
                    <div>{{ $statistic->created_at }}</div>
                </li>
            @endforeach
        </ul>
        {{ $statistics->links('vendor.admin-pagination') }}
    </div>
@endsection
