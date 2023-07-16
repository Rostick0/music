@extends('layout.admin.index')

@section('html')
    <form class="admin-filter" action="{{ url()->current() }}">
        <div class="admin-filter__inputs">
            <details class="admin-details">
                <summary class="admin-details__summary">
                    <div class="admin-input">Тип статистики</div>
                </summary>
                <div class="admin-details__content">
                    @foreach ($statistic_types as $statistic_type)
                        <label class="admin-checkbox">
                            <input class="admin-checkbox__input" type="checkbox" name="statistic_types[]"
                                @if (array_search($statistic_type->id, Request::get('statistic_types') ?? []) !== false) checked @endif value="{{ $statistic_type->id }}">
                            <span class="admin-checkbox__icon"></span>
                            <span>{{ $statistic_type->name }}</span>
                        </label>
                    @endforeach
                </div>
            </details>
            <input class="admin-input" type="search" placeholder="E-mail" name="email" value={{ Request::get('email') }}>
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
                    @if ($statistic->statistics_name == 'subscription')
                        <div>{{ $statistic->statistics_name }}
                            {{-- ({{ $statistic->type_paid ?? '' }}) --}}
                        </div>
                    @elseif ($statistic->statistics_name == 'download')
                        <a href={{ route('music.edit', ['id' => $statistic->music_id]) }}>{{ $statistic->statistics_name }}
                            ({{ $statistic->music_title }})
                        </a>
                    @else
                        <div>{{ $statistic->statistics_name }}</div>
                    @endif
                    <a href={{ route('user.edit', ['id' => $statistic->users_id]) }}>{{ $statistic->user_email }}</a>
                    <div>{{ $statistic->created_at }}</div>
                </li>
            @endforeach
        </ul>
        {{ $statistics->links('vendor.admin-pagination') }}
    </div>
@endsection
