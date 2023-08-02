@extends('layout.front.index')

@section('php')
    @php
        // $playlists = App\Models\Playlist::limit(6)->orderByDesc('id')->get();
        $genres = App\Models\Genre::all();
        $moods = App\Models\Mood::all();
        $themes = App\Models\Theme::all();
        $instruments = App\Models\Instrument::all();
        $music_controller = new App\Http\Controllers\MusicController();
        $music_list = $music_controller->search($request, '');
    @endphp
@endsection


@section('html')
    <section class="section tracks">
        <div class="container">
            <h2 class="section-title tracks__title">Tracks</h2>
            <form class="tracks__filter">
                <div class="select" tabindex="-1">
                    <div class="select__switch">
                        <div class="select__name">Genres</div>
                        <div class="select__switch_flex">
                            <div class="select__value">None</div>
                            <svg class="select__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.8">
                                    <rect width="20" height="20" rx="10" fill="url(#paint0_linear_52_644)"
                                        fill-opacity="0.15" />
                                    <path d="M6 8L9.98617 12L13.9723 8" stroke="#FF1111" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <linearGradient id="paint0_linear_52_644" x1="20" y1="0" x2="-1.86184"
                                        y2="2.29957" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FF9211" />
                                        <stop offset="1" stop-color="#FF1111" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <input class="select__input" name="genre" type="hidden">
                    </div>
                    <ul class="select__list">
                        @foreach ($genres as $genre)
                            <li class="select__item" data-id="{{ $genre->id }}">{{ $genre->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="select" tabindex="-1">
                    <div class="select__switch">
                        <div class="select__name">Moods</div>
                        <div class="select__switch_flex">
                            <div class="select__value">None</div>
                            <svg class="select__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.8">
                                    <rect width="20" height="20" rx="10" fill="url(#paint0_linear_52_644)"
                                        fill-opacity="0.15" />
                                    <path d="M6 8L9.98617 12L13.9723 8" stroke="#FF1111" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <linearGradient id="paint0_linear_52_644" x1="20" y1="0" x2="-1.86184"
                                        y2="2.29957" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FF9211" />
                                        <stop offset="1" stop-color="#FF1111" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <input class="select__input" name="moods" type="hidden">
                    </div>
                    <ul class="select__list">
                        @foreach ($moods as $mood)
                            <li class="select__item" data-id="{{ $mood->id }}">{{ $mood->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="select" tabindex="-1">
                    <div class="select__switch">
                        <div class="select__name">Themes</div>
                        <div class="select__switch_flex">
                            <div class="select__value">None</div>
                            <svg class="select__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.8">
                                    <rect width="20" height="20" rx="10" fill="url(#paint0_linear_52_644)"
                                        fill-opacity="0.15" />
                                    <path d="M6 8L9.98617 12L13.9723 8" stroke="#FF1111" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <linearGradient id="paint0_linear_52_644" x1="20" y1="0"
                                        x2="-1.86184" y2="2.29957" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FF9211" />
                                        <stop offset="1" stop-color="#FF1111" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <input class="select__input" name="themes" type="hidden">
                    </div>
                    <ul class="select__list">
                        @foreach ($themes as $theme)
                            <li class="select__item" data-id="{{ $theme->id }}">{{ $theme->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="select" tabindex="-1">
                    <div class="select__switch">
                        <div class="select__name">Instruments</div>
                        <div class="select__switch_flex">
                            <div class="select__value">None</div>
                            <svg class="select__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.8">
                                    <rect width="20" height="20" rx="10" fill="url(#paint0_linear_52_644)"
                                        fill-opacity="0.15" />
                                    <path d="M6 8L9.98617 12L13.9723 8" stroke="#FF1111" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <linearGradient id="paint0_linear_52_644" x1="20" y1="0"
                                        x2="-1.86184" y2="2.29957" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FF9211" />
                                        <stop offset="1" stop-color="#FF1111" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <input class="select__input" name="instruments" type="hidden">
                    </div>
                    <ul class="select__list">
                        @foreach ($instruments as $instrument)
                            <li class="select__item" data-id="{{ $instrument->id }}">{{ $instrument->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="select" tabindex="-1">
                    <div class="select__switch">
                        <div class="select__name">Duration</div>
                        <div class="select__switch_flex">
                            <div class="select__value">All durations</div>
                            <svg class="select__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.8">
                                    <rect width="20" height="20" rx="10" fill="url(#paint0_linear_52_644)"
                                        fill-opacity="0.15" />
                                    <path d="M6 8L9.98617 12L13.9723 8" stroke="#FF1111" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <linearGradient id="paint0_linear_52_644" x1="20" y1="0"
                                        x2="-1.86184" y2="2.29957" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FF9211" />
                                        <stop offset="1" stop-color="#FF1111" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <input class="select__input" name="duration" type="hidden">
                    </div>
                    <ul class="select__list">
                        <li class="select__item"></li>
                    </ul>
                </div>
            </form>
            <ul class="tracks__list">
                @foreach ($music_list as $music_item)
                    <li class="tracks__item track-item">
                        <div class="track-item__info">
                            <img class="track-item__img lazy"
                                data-src="{{ App\Http\Controllers\ImageController::getViewImage($music_item->image) }}"
                                alt="{{ $music_item->title }}">
                            <div class="track-item__text text-ellipsis">
                                @if ($music_item->is_free)
                                    <div class="track-item__free">FREE</div>
                                @endif
                                <div class="track-item__name">{{ $music_item->title }}</div>
                                <div class="track-item__artist">{{ $music_item->music_artist_name }}</div>
                            </div>
                        </div>
                        <div class="track-item__timer">
                            <button class="track-button track-item__button">
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="40" height="40" rx="20"
                                        fill="url(#paint0_linear_111_2751)" />
                                    <path
                                        d="M15 25.509C15.0004 25.9876 15.1322 26.4559 15.3798 26.8581C15.6273 27.2602 15.9801 27.5793 16.3961 27.7771C16.812 27.9749 17.2735 28.0431 17.7254 27.9735C18.1774 27.904 18.6006 27.6996 18.9447 27.3849L27 20.0032L18.9447 12.6169C18.6008 12.3015 18.1775 12.0966 17.7254 12.0267C17.2732 11.9568 16.8114 12.0249 16.3952 12.2228C15.979 12.4207 15.6261 12.7401 15.3787 13.1426C15.1312 13.5452 14.9998 14.014 15 14.4928V25.509Z"
                                        fill="white" />
                                    <defs>
                                        <linearGradient id="paint0_linear_111_2751" x1="40" y1="0"
                                            x2="-3.72369" y2="4.59913" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FF9211" />
                                            <stop offset="1" stop-color="#FF1111" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </button>
                            <div class="track-time track-item__time">
                                {{ App\Http\Controllers\MusicController::normalizeTime($music_item->duration) }}</div>
                        </div>
                        <div class="track-item__audio track-item__audio_{{ $music_item->id }}"
                            data-music="{{ $music_item->link }}"></div>
                        <div class="track-item__buttons">
                            <form
                                action="{{ route('favorite.create', [
                                    'music_id' => $music_item->id,
                                ]) }}"
                                method="post">
                                @csrf
                                <button class="track-item__favorite">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_98_283)">
                                            <path
                                                d="M20.6076 11L23.3959 16.5242L28.7626 17.0558C28.8903 17.0664 29.0124 17.1134 29.1143 17.1913C29.2161 17.2691 29.2936 17.3745 29.3374 17.495C29.3813 17.6154 29.3897 17.7459 29.3616 17.871C29.3336 17.9961 29.2703 18.1106 29.1792 18.2008L24.7626 22.5783L26.4001 28.5267C26.4336 28.6528 26.4299 28.786 26.3895 28.9101C26.3492 29.0343 26.2738 29.1441 26.1724 29.2264C26.0711 29.3087 25.9482 29.36 25.8184 29.3741C25.6886 29.3882 25.5575 29.3645 25.4409 29.3058L20.0001 26.6117L14.5667 29.3025C14.4501 29.3611 14.319 29.3848 14.1893 29.3708C14.0595 29.3567 13.9365 29.3054 13.8352 29.2231C13.7339 29.1408 13.6585 29.0309 13.6181 28.9068C13.5777 28.7827 13.5741 28.6495 13.6076 28.5233L15.2451 22.575L10.8251 18.1975C10.734 18.1072 10.6707 17.9928 10.6427 17.8677C10.6147 17.7426 10.6231 17.6121 10.6669 17.4916C10.7107 17.3712 10.7882 17.2658 10.8901 17.1879C10.9919 17.1101 11.114 17.0631 11.2417 17.0525L16.6084 16.5208L19.3926 11C19.4498 10.8882 19.5369 10.7943 19.644 10.7288C19.7512 10.6632 19.8744 10.6285 20.0001 10.6285C20.1257 10.6285 20.2489 10.6632 20.3561 10.7288C20.4633 10.7943 20.5503 10.8882 20.6076 11Z"
                                                stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_98_283">
                                                <rect width="20" height="20" fill="white"
                                                    transform="translate(10 10)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </button>
                            </form>
                            <a class="track-item__download"
                                href="{{ Storage::url('upload/music/' . $music_item->link) }}" download>
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_98_282)">
                                        <path d="M20.0007 13.125V23.125" stroke="#1B121E" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M16.2507 19.375L20.0007 23.125L23.7507 19.375" stroke="#1B121E"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M29.3757 23.125V24.375C29.3757 25.038 29.1123 25.6739 28.6435 26.1428C28.1747 26.6116 27.5388 26.875 26.8757 26.875H13.1257C12.4627 26.875 11.8268 26.6116 11.358 26.1428C10.8891 25.6739 10.6257 25.038 10.6257 24.375V23.125"
                                            stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_98_282">
                                            <rect width="20" height="20" fill="white"
                                                transform="translate(10 10)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                            <a class="track-item__buy" href="/pricing">
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_98_281)">
                                        <path
                                            d="M15 25.9374H23.2675C23.5627 25.9375 23.8485 25.833 24.0742 25.6424C24.2997 25.4519 24.4506 25.1877 24.5 24.8966L26.6975 11.9799C26.7471 11.689 26.898 11.4249 27.1236 11.2346C27.3492 11.0443 27.6348 10.9399 27.93 10.9399H28.75"
                                            stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M16.5625 28.4375C16.3899 28.4375 16.25 28.2976 16.25 28.125C16.25 27.9524 16.3899 27.8125 16.5625 27.8125"
                                            stroke="#1B121E" stroke-width="1.5" />
                                        <path
                                            d="M16.5625 28.4375C16.7351 28.4375 16.875 28.2976 16.875 28.125C16.875 27.9524 16.7351 27.8125 16.5625 27.8125"
                                            stroke="#1B121E" stroke-width="1.5" />
                                        <path
                                            d="M22.8125 28.4375C22.6399 28.4375 22.5 28.2976 22.5 28.125C22.5 27.9524 22.6399 27.8125 22.8125 27.8125"
                                            stroke="#1B121E" stroke-width="1.5" />
                                        <path
                                            d="M22.8125 28.4375C22.9851 28.4375 23.125 28.2976 23.125 28.125C23.125 27.9524 22.9851 27.8125 22.8125 27.8125"
                                            stroke="#1B121E" stroke-width="1.5" />
                                        <path
                                            d="M24.9607 22.1875H14.9015C14.3441 22.1875 13.8027 22.0011 13.3633 21.658C12.9239 21.315 12.6118 20.835 12.4765 20.2942L11.2682 15.4609C11.2451 15.3687 11.2434 15.2725 11.2631 15.1795C11.2828 15.0866 11.3235 14.9994 11.382 14.9245C11.4405 14.8496 11.5152 14.789 11.6007 14.7474C11.6861 14.7058 11.7798 14.6842 11.8749 14.6842H26.2365"
                                            stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_98_281">
                                            <rect width="20" height="20" fill="white"
                                                transform="translate(10 10)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
    </section>
@endsection
