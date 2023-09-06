@extends('layout.front.index')

@section('php')
    @php
        $music_kit = App\Http\Controllers\FrontMusicKitController::getById($id);
        $artist_name = App\Models\MusicArtist::find($music_kit->music_artist_id)->name;
        $music_list = App\Http\Controllers\FrontMusicKitController::getSimilar($music_kit->id);
    @endphp
@endsection

@section('seo_title', $site_page?->seo_title)
@section('seo_description', $site_page?->seo_description)

@section('html')
    <section class="section-page track">
        <div class="track__top">
            <div class="container">
                <div class="track__info">
                    <div class="track__image">
                        <div class="track__image_inner">
                            <img class="track__img lazy"
                                data-src="{{ App\Http\Controllers\ImageController::getViewImage($music_kit->image) }}"
                                alt="">
                        </div>
                    </div>
                    <div class="track__info_text">
                        <h1 class="section-title-big track__title">{{ $music_kit->title }}</h1>
                        <div class="track__artist">{{ $music_kit->artist->artist_name }}</div>
                        @if ($music_kit->description)
                            <p class="track__description text-medium">{!! $music_kit->description !!}</p>
                        @endif
                    </div>
                </div>
                <ul class="track__version">
                    <li class="track__version trakc-version">
                        <div class="track-version__name text-medium">Music kit</div>
                        <div class="track-version__item track-item tracks__item track-item__{{ $music_kit->id }} track-item__type_music"
                            data-music="{{ App\Http\Controllers\MusicDownloadController::getLink($music_kit->link, $music_kit->link_demo, $music_kit->is_free) }}"
                            data-title="{{ $music_kit->title }}" data-id="{{ $music_kit->id }}" data-type="music_kit"
                            data-favorite="{{ $favorite($music_kit?->favorite_id, $music_kit->id, 'music_kit') }}"
                            data-artist="{{ $music_kit->artist->artist_name }}"
                            data-time="{{ App\Http\Controllers\MusicController::timeFullOrDemo($music_kit->duration, $music_kit->duration_demo, $music_kit->is_free) }}">
                            <div class="track-item__timer">
                                <button class="track-button track-item__button">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="40" height="40" rx="20"
                                            fill="url(#paint0_linear_111_2751)" />
                                        <g class="track-item__button_start">
                                            <path
                                                d="M15 25.509C15.0004 25.9876 15.1322 26.4559 15.3798 26.8581C15.6273 27.2602 15.9801 27.5793 16.3961 27.7771C16.812 27.9749 17.2735 28.0431 17.7254 27.9735C18.1774 27.904 18.6006 27.6996 18.9447 27.3849L27 20.0032L18.9447 12.6169C18.6008 12.3015 18.1775 12.0966 17.7254 12.0267C17.2732 11.9568 16.8114 12.0249 16.3952 12.2228C15.979 12.4207 15.6261 12.7401 15.3787 13.1426C15.1312 13.5452 14.9998 14.014 15 14.4928V25.509Z"
                                                fill="white" />
                                        </g>
                                        <g class="track-item__button_pause">
                                            <path d="M15.9998 13.6665V27.0002" stroke="white" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M24 13.6665V27.0002" stroke="white" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </g>
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
                                    {{ App\Http\Controllers\MusicController::timeFullOrDemo($music_kit->duration, $music_kit->duration_demo, $music_kit->is_free) }}
                                </div>
                            </div>
                            <a class="track-item__info" href="/music_kit/{{ $music_kit->id }}" rel="noreferrer noopener"
                                hidden></a>
                            <div class="track-item__buttons">
                                @if ($favorite($music_kit->favorite_id, $music_kit->id, 'music_kit'))
                                    <form action="{{ route('favorite.delete') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="type" value="music_kit">
                                        <input type="hidden" name="type_id" value="{{ $music_kit->id }}">
                                        <button class="track-item__favorite _active">
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
                                @else
                                    <form action="{{ route('favorite.create') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="type" value="music_kit">
                                        <input type="hidden" name="type_id" value="{{ $music_kit->id }}">
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
                                @endif
                                <a class="track-item__download"
                                    href="{{ App\Http\Controllers\MusicDownloadController::getLink($music_kit->link, $music_kit->link_demo, $music_kit->is_free) }}"
                                    download>
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
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="section-main">
            <div class="container">
                <ul class="track__category">
                    @if ($music_kit->genres->count())
                        <li class="track__category_item category-item">
                            <div class="category-item__name section-title">Genres</div>
                            <ul class="category-item__list">
                                @foreach ($music_kit->genres as $genre)
                                    <li class="category-item__item">
                                        <a class="category-item__link text-medium"
                                            href="/tracks?genre={{ $genre->id }}">
                                            {{ $genre->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                    @if ($music_kit->moods->count())
                        <li class="track__category_item category-item">
                            <div class="category-item__name section-title">Moods</div>
                            <ul class="category-item__list">
                                @foreach ($music_kit->moods as $mood)
                                    <li class="category-item__item">
                                        <a class="category-item__link text-medium"
                                            href="/tracks?mood={{ $mood->id }}">
                                            {{ $mood->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                    @if ($music_kit->instruments->count())
                        <li class="track__category_item category-item">
                            <div class="category-item__name section-title">Instruments</div>
                            <ul class="category-item__list">
                                @foreach ($music_kit->instruments as $instrument)
                                    <li class="category-item__item">
                                        <a class="category-item__link text-medium"
                                            href="/tracks?instrument={{ $instrument->id }}">
                                            {{ $instrument->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                    @if ($music_kit->themes->count())
                        <li class="track__category_item category-item">
                            <div class="category-item__name section-title">Themes</div>
                            <ul class="category-item__list">
                                @foreach ($music_kit->themes as $theme)
                                    <li class="category-item__item">
                                        <a class="category-item__link text-medium"
                                            href="/tracks?theme={{ $theme->id }}">
                                            {{ $theme->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        @if ($music_kit->parts->count())
            <div class="tracks section-main">
                <div class="container">
                    <h2 class="section-title tracks__title">Music kit versions included</h2>
                    <ul class="tracks__list">
                        @foreach ($music_kit->parts as $part)
                            <x-music_part_include :music_item="$part" type="part" :author="$music_kit->artist->artist_name" :image="$music_kit->image" />
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (!empty($music_list))
            <div class="tracks section-main">
                <div class="container">
                    <h2 class="section-title tracks__title">Similar tracks</h2>
                    <ul class="tracks__list">
                        <x-music_kit_list :music_kit_list="[...$music_list]" />
                    </ul>
                </div>
            </div>
        @endif
    </section>
    <x-player />
@endsection
