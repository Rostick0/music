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
    <x-main-banner />
    <section class="section section-main playlist">
        <div class="container">
            <h2 class="section-title playlist__title">Playlists</h2>
            <div class="playlist__list">
                <a class="playlist__link playlist-item" href="">
                    <img class="playlist-item__img lazy" decoding="async" loading="lazy" data-src="/img/playlist.png"
                        alt="">
                    <div class="playlist-item__icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_52_568)">
                                <path
                                    d="M18.125 1.25H1.875C1.18464 1.25 0.625 1.80964 0.625 2.5V17.5C0.625 18.1904 1.18464 18.75 1.875 18.75H18.125C18.8154 18.75 19.375 18.1904 19.375 17.5V2.5C19.375 1.80964 18.8154 1.25 18.125 1.25Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3.95825 1.25V18.75" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M8.22511 14.3833C9.09036 14.3833 9.79178 13.6819 9.79178 12.8167C9.79178 11.9514 9.09036 11.25 8.22511 11.25C7.35987 11.25 6.65845 11.9514 6.65845 12.8167C6.65845 13.6819 7.35987 14.3833 8.22511 14.3833Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M14.4834 12.5083C15.3487 12.5083 16.0501 11.8069 16.0501 10.9417C16.0501 10.0764 15.3487 9.375 14.4834 9.375C13.6182 9.375 12.9167 10.0764 12.9167 10.9417C12.9167 11.8069 13.6182 12.5083 14.4834 12.5083Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M9.79186 12.8167V7.29166C9.78836 7.03177 9.86705 6.77741 10.0167 6.56491C10.1664 6.3524 10.3793 6.1926 10.6252 6.10833L14.3752 5.06666C14.5623 5.00212 14.7622 4.98357 14.9581 5.01258C15.1539 5.04159 15.3398 5.11731 15.5002 5.23333C15.6598 5.3506 15.7897 5.50366 15.8794 5.68023C15.9691 5.85679 16.0162 6.05194 16.0169 6.24999V10.9417"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_52_568">
                                    <rect width="20" height="20" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="playlist-item__title text-big">Electronic & Dance</div>
                </a>
                <a class="playlist__link playlist-item" href="">
                    <img class="playlist-item__img lazy" decoding="async" loading="lazy" data-src="/img/playlist 2.png"
                        alt="">
                    <div class="playlist-item__icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_52_568)">
                                <path
                                    d="M18.125 1.25H1.875C1.18464 1.25 0.625 1.80964 0.625 2.5V17.5C0.625 18.1904 1.18464 18.75 1.875 18.75H18.125C18.8154 18.75 19.375 18.1904 19.375 17.5V2.5C19.375 1.80964 18.8154 1.25 18.125 1.25Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3.95825 1.25V18.75" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M8.22511 14.3833C9.09036 14.3833 9.79178 13.6819 9.79178 12.8167C9.79178 11.9514 9.09036 11.25 8.22511 11.25C7.35987 11.25 6.65845 11.9514 6.65845 12.8167C6.65845 13.6819 7.35987 14.3833 8.22511 14.3833Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M14.4834 12.5083C15.3487 12.5083 16.0501 11.8069 16.0501 10.9417C16.0501 10.0764 15.3487 9.375 14.4834 9.375C13.6182 9.375 12.9167 10.0764 12.9167 10.9417C12.9167 11.8069 13.6182 12.5083 14.4834 12.5083Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M9.79186 12.8167V7.29166C9.78836 7.03177 9.86705 6.77741 10.0167 6.56491C10.1664 6.3524 10.3793 6.1926 10.6252 6.10833L14.3752 5.06666C14.5623 5.00212 14.7622 4.98357 14.9581 5.01258C15.1539 5.04159 15.3398 5.11731 15.5002 5.23333C15.6598 5.3506 15.7897 5.50366 15.8794 5.68023C15.9691 5.85679 16.0162 6.05194 16.0169 6.24999V10.9417"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_52_568">
                                    <rect width="20" height="20" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="playlist-item__title text-big">Tropical</div>
                </a>
                <a class="playlist__link playlist-item" href="">
                    <img class="playlist-item__img lazy" decoding="async" loading="lazy" data-src="/img/playlist 3.png"
                        alt="">
                    <div class="playlist-item__icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_52_568)">
                                <path
                                    d="M18.125 1.25H1.875C1.18464 1.25 0.625 1.80964 0.625 2.5V17.5C0.625 18.1904 1.18464 18.75 1.875 18.75H18.125C18.8154 18.75 19.375 18.1904 19.375 17.5V2.5C19.375 1.80964 18.8154 1.25 18.125 1.25Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3.95825 1.25V18.75" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M8.22511 14.3833C9.09036 14.3833 9.79178 13.6819 9.79178 12.8167C9.79178 11.9514 9.09036 11.25 8.22511 11.25C7.35987 11.25 6.65845 11.9514 6.65845 12.8167C6.65845 13.6819 7.35987 14.3833 8.22511 14.3833Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M14.4834 12.5083C15.3487 12.5083 16.0501 11.8069 16.0501 10.9417C16.0501 10.0764 15.3487 9.375 14.4834 9.375C13.6182 9.375 12.9167 10.0764 12.9167 10.9417C12.9167 11.8069 13.6182 12.5083 14.4834 12.5083Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M9.79186 12.8167V7.29166C9.78836 7.03177 9.86705 6.77741 10.0167 6.56491C10.1664 6.3524 10.3793 6.1926 10.6252 6.10833L14.3752 5.06666C14.5623 5.00212 14.7622 4.98357 14.9581 5.01258C15.1539 5.04159 15.3398 5.11731 15.5002 5.23333C15.6598 5.3506 15.7897 5.50366 15.8794 5.68023C15.9691 5.85679 16.0162 6.05194 16.0169 6.24999V10.9417"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_52_568">
                                    <rect width="20" height="20" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="playlist-item__title text-big">Pop Music</div>
                </a>
                <a class="playlist__link playlist-item" href="">
                    <img class="playlist-item__img lazy" decoding="async" loading="lazy" data-src="/img/playlist 4.png"
                        alt="">
                    <div class="playlist-item__icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_52_568)">
                                <path
                                    d="M18.125 1.25H1.875C1.18464 1.25 0.625 1.80964 0.625 2.5V17.5C0.625 18.1904 1.18464 18.75 1.875 18.75H18.125C18.8154 18.75 19.375 18.1904 19.375 17.5V2.5C19.375 1.80964 18.8154 1.25 18.125 1.25Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3.95825 1.25V18.75" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M8.22511 14.3833C9.09036 14.3833 9.79178 13.6819 9.79178 12.8167C9.79178 11.9514 9.09036 11.25 8.22511 11.25C7.35987 11.25 6.65845 11.9514 6.65845 12.8167C6.65845 13.6819 7.35987 14.3833 8.22511 14.3833Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M14.4834 12.5083C15.3487 12.5083 16.0501 11.8069 16.0501 10.9417C16.0501 10.0764 15.3487 9.375 14.4834 9.375C13.6182 9.375 12.9167 10.0764 12.9167 10.9417C12.9167 11.8069 13.6182 12.5083 14.4834 12.5083Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M9.79186 12.8167V7.29166C9.78836 7.03177 9.86705 6.77741 10.0167 6.56491C10.1664 6.3524 10.3793 6.1926 10.6252 6.10833L14.3752 5.06666C14.5623 5.00212 14.7622 4.98357 14.9581 5.01258C15.1539 5.04159 15.3398 5.11731 15.5002 5.23333C15.6598 5.3506 15.7897 5.50366 15.8794 5.68023C15.9691 5.85679 16.0162 6.05194 16.0169 6.24999V10.9417"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_52_568">
                                    <rect width="20" height="20" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="playlist-item__title text-big">New</div>
                </a>
                <a class="playlist__link playlist-item" href="">
                    <img class="playlist-item__img lazy" decoding="async" loading="lazy" data-src="/img/playlist 5.png"
                        alt="">
                    <div class="playlist-item__icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_52_568)">
                                <path
                                    d="M18.125 1.25H1.875C1.18464 1.25 0.625 1.80964 0.625 2.5V17.5C0.625 18.1904 1.18464 18.75 1.875 18.75H18.125C18.8154 18.75 19.375 18.1904 19.375 17.5V2.5C19.375 1.80964 18.8154 1.25 18.125 1.25Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3.95825 1.25V18.75" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M8.22511 14.3833C9.09036 14.3833 9.79178 13.6819 9.79178 12.8167C9.79178 11.9514 9.09036 11.25 8.22511 11.25C7.35987 11.25 6.65845 11.9514 6.65845 12.8167C6.65845 13.6819 7.35987 14.3833 8.22511 14.3833Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M14.4834 12.5083C15.3487 12.5083 16.0501 11.8069 16.0501 10.9417C16.0501 10.0764 15.3487 9.375 14.4834 9.375C13.6182 9.375 12.9167 10.0764 12.9167 10.9417C12.9167 11.8069 13.6182 12.5083 14.4834 12.5083Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M9.79186 12.8167V7.29166C9.78836 7.03177 9.86705 6.77741 10.0167 6.56491C10.1664 6.3524 10.3793 6.1926 10.6252 6.10833L14.3752 5.06666C14.5623 5.00212 14.7622 4.98357 14.9581 5.01258C15.1539 5.04159 15.3398 5.11731 15.5002 5.23333C15.6598 5.3506 15.7897 5.50366 15.8794 5.68023C15.9691 5.85679 16.0162 6.05194 16.0169 6.24999V10.9417"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_52_568">
                                    <rect width="20" height="20" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="playlist-item__title text-big">Indie</div>
                </a>
                <a class="playlist__link playlist-item" href="">
                    <img class="playlist-item__img lazy" decoding="async" loading="lazy" data-src="/img/playlist 6.png"
                        alt="">
                    <div class="playlist-item__icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_52_568)">
                                <path
                                    d="M18.125 1.25H1.875C1.18464 1.25 0.625 1.80964 0.625 2.5V17.5C0.625 18.1904 1.18464 18.75 1.875 18.75H18.125C18.8154 18.75 19.375 18.1904 19.375 17.5V2.5C19.375 1.80964 18.8154 1.25 18.125 1.25Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3.95825 1.25V18.75" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M8.22511 14.3833C9.09036 14.3833 9.79178 13.6819 9.79178 12.8167C9.79178 11.9514 9.09036 11.25 8.22511 11.25C7.35987 11.25 6.65845 11.9514 6.65845 12.8167C6.65845 13.6819 7.35987 14.3833 8.22511 14.3833Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M14.4834 12.5083C15.3487 12.5083 16.0501 11.8069 16.0501 10.9417C16.0501 10.0764 15.3487 9.375 14.4834 9.375C13.6182 9.375 12.9167 10.0764 12.9167 10.9417C12.9167 11.8069 13.6182 12.5083 14.4834 12.5083Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M9.79186 12.8167V7.29166C9.78836 7.03177 9.86705 6.77741 10.0167 6.56491C10.1664 6.3524 10.3793 6.1926 10.6252 6.10833L14.3752 5.06666C14.5623 5.00212 14.7622 4.98357 14.9581 5.01258C15.1539 5.04159 15.3398 5.11731 15.5002 5.23333C15.6598 5.3506 15.7897 5.50366 15.8794 5.68023C15.9691 5.85679 16.0162 6.05194 16.0169 6.24999V10.9417"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_52_568">
                                    <rect width="20" height="20" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="playlist-item__title text-big">Funky</div>
                </a>
            </div>
            <a class="button-white-border button__all playlist__all" href="/playlists">See all playlists</a>
        </div>
    </section>

    <section class="section section-main tracks">
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
                                    <linearGradient id="paint0_linear_52_644" x1="20" y1="0"
                                        x2="-1.86184" y2="2.29957" gradientUnits="userSpaceOnUse">
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
                                    <linearGradient id="paint0_linear_52_644" x1="20" y1="0"
                                        x2="-1.86184" y2="2.29957" gradientUnits="userSpaceOnUse">
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
                        <div class="track-item__audio track-item__audio_{{ $music_item->id }}"></div>

                        <div class="track-item__buttons">
                            @if (
                                $music_item->favorite_id ||
                                    (is_array(json_decode(Cookie::get('favorite'))) &&
                                        in_array($music_item->id, json_decode(Cookie::get('favorite')))))
                                <form
                                    action="{{ route('favorite.delete', [
                                        'id' => $music_item->id,
                                    ]) }}"
                                    method="post">
                                    @csrf
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
                            @endif
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
            <a class="button-white-border button__all tracks__all" href="/tracks">Show more</a>
    </section>

    <section class="section section-main faq">
        <div class="container">
            <h2 class="section-title faq__title">FAQ</h2>
            <ul class="faq__list">
                <li class="faq__item">
                    <div class="faq__switch">
                        <div class="faq__question text-big">Is Royalty Free the same as No Copyright?</div>
                        <div class="faq__icon"></div>
                    </div>
                    <div class="faq__answer text-medium">13</div>
                </li>
                <li class="faq__item">
                    <div class="faq__switch">
                        <div class="faq__question text-big">Can I use Topaudio music in a YouTube video?</div>
                        <div class="faq__icon"></div>
                    </div>
                    <div class="faq__answer text-medium">Yes! You are welcome to use Topaudio music in your YouTube videos,
                        and
                        you can even monetize them. In case you receive a copyright claim, we has provided
                        a simple
                        form where you can submit the link to your video and have the claim
                        removed: https://topaudio.store/claim</div>
                </li>
            </ul>
        </div>
    </section>

    <section class="section section-main introducing">
        <div class="container">
            <h2 class="section-title introducing__title">Introducing «Top Audio»</h2>
            <h3 class="section-subtitle introducing__subtitle text-big">The Choice of Global Titans for Premium Music!
            </h3>
            <ul class="introducing__list text-medium">
                <li class="introducing__item">
                    <svg class="introducing__icon" width="60" height="60" viewBox="0 0 60 60" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M48.92 43.025C51.8922 39.0495 53.5372 34.239 53.6216 29.2759C53.7059 24.3129 52.2254 19.4493 49.39 15.375L42.64 22.7775C40.3955 15.9382 40.6829 8.5201 43.45 1.875C38.2949 2.13624 33.2932 3.71717 28.9244 6.46627C24.5556 9.21536 20.9662 13.0405 18.5 17.575L13.125 12.3425C9.3042 16.2423 6.95184 21.345 6.46782 26.7831C5.98381 32.2212 7.398 37.6592 10.47 42.1725"
                            stroke="url(#paint0_linear_52_678)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M17.0625 58.125C19.6513 58.125 21.75 56.0263 21.75 53.4375C21.75 50.8487 19.6513 48.75 17.0625 48.75C14.4737 48.75 12.375 50.8487 12.375 53.4375C12.375 56.0263 14.4737 58.125 17.0625 58.125Z"
                            stroke="url(#paint1_linear_52_678)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M35.8125 52.5C38.4013 52.5 40.5 50.4013 40.5 47.8125C40.5 45.2237 38.4013 43.125 35.8125 43.125C33.2237 43.125 31.125 45.2237 31.125 47.8125C31.125 50.4013 33.2237 52.5 35.8125 52.5Z"
                            stroke="url(#paint2_linear_52_678)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M21.75 53.4375V36.4525C21.7501 35.6654 21.9978 34.8982 22.4582 34.2597C22.9186 33.6212 23.5682 33.1438 24.315 32.895L35.565 29.77C36.1286 29.5823 36.7288 29.5312 37.3161 29.6209C37.9034 29.7105 38.461 29.9385 38.9429 30.2859C39.4248 30.6333 39.8173 31.0902 40.088 31.619C40.3587 32.1479 40.4999 32.7334 40.5 33.3275V47.8125"
                            stroke="url(#paint3_linear_52_678)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <defs>
                            <linearGradient id="paint0_linear_52_678" x1="53.625" y1="1.875" x2="2.1555"
                                y2="8.09145" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint1_linear_52_678" x1="21.75" y1="48.75" x2="11.5023"
                                y2="49.8279" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint2_linear_52_678" x1="40.5" y1="43.125" x2="30.2523"
                                y2="44.2029" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint3_linear_52_678" x1="40.5" y1="29.5779" x2="19.9184"
                                y2="31.2792" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <p>
                        Welcome to «Top Audio,» where exceptional music meets big opportunities. Our platform,
                        created by two visionary musicians, is the go-to destination for bloggers and content
                        creators looking for premium tracks.
                    </p>
                </li>
                <li class="introducing__item">
                    <svg class="introducing__icon" width="60" height="60" viewBox="0 0 60 60" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.875 42.8274H48.125C48.788 42.8274 49.424 43.0906 49.8927 43.5596C50.3615 44.0284 50.625 44.6644 50.625 45.3274V57.8274H9.375V45.3274C9.375 44.6644 9.6384 44.0284 10.1072 43.5596C10.5761 43.0906 11.212 42.8274 11.875 42.8274Z"
                            stroke="url(#paint0_linear_52_696)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M15.625 20.3274H44.375C45.038 20.3274 45.674 20.5908 46.1427 21.0596C46.6115 21.5285 46.875 22.1643 46.875 22.8274V42.8274H13.125V22.8274C13.125 22.1643 13.3884 21.5285 13.8572 21.0596C14.3261 20.5908 14.962 20.3274 15.625 20.3274Z"
                            stroke="url(#paint1_linear_52_696)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M43.125 12.8274H16.875V20.3274H43.125V12.8274Z" stroke="url(#paint2_linear_52_696)"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M31.22 2.62247C30.8797 2.33226 30.4473 2.17285 30 2.17285C29.5527 2.17285 29.1203 2.33226 28.78 2.62247L16.875 12.8275H43.125L31.22 2.62247Z"
                            stroke="url(#paint3_linear_52_696)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M5.625 57.8274H54.375" stroke="url(#paint4_linear_52_696)" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M24.375 28.7649C23.8572 28.7649 23.4375 28.3451 23.4375 27.8274C23.4375 27.3096 23.8572 26.8899 24.375 26.8899"
                            stroke="url(#paint5_linear_52_696)" stroke-width="2" />
                        <path
                            d="M24.375 28.7649C24.8928 28.7649 25.3125 28.3451 25.3125 27.8274C25.3125 27.3096 24.8928 26.8899 24.375 26.8899"
                            stroke="url(#paint6_linear_52_696)" stroke-width="2" />
                        <path
                            d="M24.375 36.2649C23.8572 36.2649 23.4375 35.8451 23.4375 35.3274C23.4375 34.8096 23.8572 34.3899 24.375 34.3899"
                            stroke="url(#paint7_linear_52_696)" stroke-width="2" />
                        <path
                            d="M24.375 36.2649C24.8928 36.2649 25.3125 35.8451 25.3125 35.3274C25.3125 34.8096 24.8928 34.3899 24.375 34.3899"
                            stroke="url(#paint8_linear_52_696)" stroke-width="2" />
                        <path
                            d="M20.625 51.2649C20.1072 51.2649 19.6875 50.8451 19.6875 50.3274C19.6875 49.8096 20.1072 49.3899 20.625 49.3899"
                            stroke="url(#paint9_linear_52_696)" stroke-width="2" />
                        <path
                            d="M20.625 51.2649C21.1428 51.2649 21.5625 50.8451 21.5625 50.3274C21.5625 49.8096 21.1428 49.3899 20.625 49.3899"
                            stroke="url(#paint10_linear_52_696)" stroke-width="2" />
                        <path
                            d="M30 51.2649C29.4822 51.2649 29.0625 50.8451 29.0625 50.3274C29.0625 49.8096 29.4822 49.3899 30 49.3899"
                            stroke="url(#paint11_linear_52_696)" stroke-width="2" />
                        <path
                            d="M30 51.2649C30.5178 51.2649 30.9375 50.8451 30.9375 50.3274C30.9375 49.8096 30.5178 49.3899 30 49.3899"
                            stroke="url(#paint12_linear_52_696)" stroke-width="2" />
                        <path
                            d="M39.375 51.2649C38.8572 51.2649 38.4375 50.8451 38.4375 50.3274C38.4375 49.8096 38.8572 49.3899 39.375 49.3899"
                            stroke="url(#paint13_linear_52_696)" stroke-width="2" />
                        <path
                            d="M39.375 51.2649C39.8928 51.2649 40.3125 50.8451 40.3125 50.3274C40.3125 49.8096 39.8928 49.3899 39.375 49.3899"
                            stroke="url(#paint14_linear_52_696)" stroke-width="2" />
                        <path
                            d="M35.625 28.7649C35.1072 28.7649 34.6875 28.3451 34.6875 27.8274C34.6875 27.3096 35.1072 26.8899 35.625 26.8899"
                            stroke="url(#paint15_linear_52_696)" stroke-width="2" />
                        <path
                            d="M35.625 28.7649C36.1428 28.7649 36.5625 28.3451 36.5625 27.8274C36.5625 27.3096 36.1428 26.8899 35.625 26.8899"
                            stroke="url(#paint16_linear_52_696)" stroke-width="2" />
                        <path
                            d="M35.625 36.2649C35.1072 36.2649 34.6875 35.8451 34.6875 35.3274C34.6875 34.8096 35.1072 34.3899 35.625 34.3899"
                            stroke="url(#paint17_linear_52_696)" stroke-width="2" />
                        <path
                            d="M35.625 36.2649C36.1428 36.2649 36.5625 35.8451 36.5625 35.3274C36.5625 34.8096 36.1428 34.3899 35.625 34.3899"
                            stroke="url(#paint18_linear_52_696)" stroke-width="2" />
                        <defs>
                            <linearGradient id="paint0_linear_52_696" x1="50.625" y1="42.8274" x2="8.55608"
                                y2="54.9963" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint1_linear_52_696" x1="46.875" y1="20.3274" x2="10.481"
                                y2="26.0696" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint2_linear_52_696" x1="43.125" y1="12.8274" x2="17.5766"
                                y2="22.2331" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint3_linear_52_696" x1="43.125" y1="2.17285" x2="15.9396"
                                y2="9.21794" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint4_linear_52_696" x1="54.375" y1="57.8274" x2="52.4011"
                                y2="67.9494" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint5_linear_52_696" x1="24.375" y1="26.8899" x2="23.3417"
                                y2="26.9442" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint6_linear_52_696" x1="25.3125" y1="26.8899" x2="24.2792"
                                y2="26.9442" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint7_linear_52_696" x1="24.375" y1="34.3899" x2="23.3417"
                                y2="34.4442" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint8_linear_52_696" x1="25.3125" y1="34.3899" x2="24.2792"
                                y2="34.4442" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint9_linear_52_696" x1="20.625" y1="49.3899" x2="19.5917"
                                y2="49.4442" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint10_linear_52_696" x1="21.5625" y1="49.3899" x2="20.5292"
                                y2="49.4442" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint11_linear_52_696" x1="30" y1="49.3899" x2="28.9667"
                                y2="49.4442" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint12_linear_52_696" x1="30.9375" y1="49.3899" x2="29.9042"
                                y2="49.4442" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint13_linear_52_696" x1="39.375" y1="49.3899" x2="38.3417"
                                y2="49.4442" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint14_linear_52_696" x1="40.3125" y1="49.3899" x2="39.2792"
                                y2="49.4442" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint15_linear_52_696" x1="35.625" y1="26.8899" x2="34.5917"
                                y2="26.9442" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint16_linear_52_696" x1="36.5625" y1="26.8899" x2="35.5292"
                                y2="26.9442" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint17_linear_52_696" x1="35.625" y1="34.3899" x2="34.5917"
                                y2="34.4442" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint18_linear_52_696" x1="36.5625" y1="34.3899" x2="35.5292"
                                y2="34.4442" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <p>
                        Trusted by industry giants like Coca-Cola and Samsung, «Top Audio» is the go-to platform
                        for captivating and memorable music that leaves a lasting impact.
                    </p>
                </li>
                <li class="introducing__item">
                    <svg class="introducing__icon" width="60" height="60" viewBox="0 0 60 60" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_52_688)">
                            <path
                                d="M44.8676 29.2L48.7201 39.375H56.2201C56.5985 39.3596 56.9724 39.4615 57.2907 39.6668C57.609 39.8721 57.8561 40.1708 57.9981 40.5219C58.1402 40.873 58.1702 41.2594 58.0842 41.6283C57.9982 41.9971 57.8003 42.3304 57.5176 42.5825L51.0175 47.1225L54.6251 55.405C54.7831 55.7846 54.8181 56.2042 54.725 56.6048C54.632 57.0053 54.4156 57.3666 54.1064 57.6377C53.7972 57.9088 53.4108 58.0761 53.0015 58.116C52.5922 58.1558 52.1808 58.0663 51.825 57.86L43.1001 52.9575L34.3826 57.86C34.0269 58.0653 33.6158 58.1541 33.2071 58.1138C32.7983 58.0735 32.4125 57.9061 32.1038 57.6352C31.7951 57.3643 31.579 57.0035 31.486 56.6035C31.393 56.2034 31.4276 55.7843 31.5851 55.405L35.1926 47.1225L28.6926 42.5825C28.4092 42.3316 28.2103 41.9992 28.1232 41.6309C28.0361 41.2625 28.0651 40.8763 28.206 40.525C28.347 40.1738 28.5932 39.8747 28.9108 39.6688C29.2284 39.4629 29.6018 39.3603 29.9801 39.375H37.4801L41.3426 29.2C41.5135 28.8812 41.7677 28.6148 42.0781 28.4291C42.3884 28.2433 42.7434 28.1453 43.1051 28.1453C43.4667 28.1453 43.8217 28.2433 44.132 28.4291C44.4424 28.6148 44.6966 28.8812 44.8676 29.2Z"
                                stroke="url(#paint0_linear_52_688)" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M24.4 57.5674C19.1832 56.5081 14.3742 53.9901 10.5316 50.3061C6.6891 46.6221 3.97085 41.9234 2.69276 36.7558C1.41466 31.5883 1.6292 26.1642 3.31144 21.1137C4.99367 16.0633 8.07454 11.5939 12.196 8.22491C16.3175 4.85591 21.3104 2.72564 26.5946 2.08162C31.8787 1.43761 37.2371 2.30629 42.0472 4.58674C46.8572 6.86719 50.9214 10.4658 53.7674 14.9643C56.6134 19.4629 58.1245 24.6767 58.125 29.9999"
                                stroke="url(#paint1_linear_52_688)" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M23.2225 57.305C19.42 51.7225 16.875 41.5825 16.875 30C16.875 18.4175 19.42 8.28001 23.2225 2.69751"
                                stroke="url(#paint2_linear_52_688)" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M1.9375 28.125H31.875" stroke="url(#paint3_linear_52_688)" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7.49756 13.125H52.5001" stroke="url(#paint4_linear_52_688)" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M5.12 43.125H18.035" stroke="url(#paint5_linear_52_688)" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M36.7775 2.69751C39.9958 8.13405 41.9602 14.2203 42.5275 20.5125"
                                stroke="url(#paint6_linear_52_688)" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </g>
                        <defs>
                            <linearGradient id="paint0_linear_52_688" x1="58.1322" y1="28.1453" x2="25.2777"
                                y2="31.6101" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint1_linear_52_688" x1="58.125" y1="1.875" x2="-3.35324"
                                y2="8.40699" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint2_linear_52_688" x1="23.2225" y1="2.69751" x2="16.2084"
                                y2="2.78327" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint3_linear_52_688" x1="31.875" y1="28.125" x2="28.8441"
                                y2="37.6694" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint4_linear_52_688" x1="52.5001" y1="13.125" x2="50.3753"
                                y2="23.1831" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint5_linear_52_688" x1="18.035" y1="43.125" x2="13.0188"
                                y2="49.9394" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint6_linear_52_688" x1="42.5275" y1="2.69751" x2="36.18"
                                y2="2.91301" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <clipPath id="clip0_52_688">
                                <rect width="60" height="60" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    <p>
                        Unlock a world of premium tracks on «Top Audio,» carefully crafted to elevate your
                        content and captivate your audience like never before.
                    </p>
                </li>
                <li class="introducing__item">
                    <svg class="introducing__icon" width="60" height="60" viewBox="0 0 60 60"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.825 32.5001C16.4595 30.3247 15.7017 27.8233 15.6305 25.2559C15.5593 22.6885 16.1773 20.1489 17.4202 17.9012C18.6631 15.6536 20.4854 13.78 22.6978 12.4753C24.9101 11.1706 27.4316 10.4824 30 10.4824C32.5684 10.4824 35.0899 11.1706 37.3022 12.4753C39.5146 13.78 41.3369 15.6536 42.5798 17.9012C43.8227 20.1489 44.4407 22.6885 44.3695 25.2559C44.2983 27.8233 43.5405 30.3247 42.175 32.5001"
                            stroke="url(#paint0_linear_52_683)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M12.8251 40.95C9.77663 37.614 7.76403 33.4635 7.03245 29.0041C6.30088 24.5447 6.8819 19.9687 8.70475 15.8336C10.5276 11.6985 13.5136 8.18272 17.2991 5.7145C21.0845 3.24627 25.5061 1.93213 30.0251 1.93213C34.5442 1.93213 38.9657 3.24627 42.7512 5.7145C46.5366 8.18272 49.5226 11.6985 51.3455 15.8336C53.1683 19.9687 53.7493 24.5447 53.0178 29.0041C52.2862 33.4635 50.2736 37.614 47.2251 40.95"
                            stroke="url(#paint1_linear_52_683)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M37.9749 41.5001C38.0376 40.8067 37.9548 40.1078 37.7317 39.4482C37.5086 38.7887 37.1503 38.183 36.6796 37.6699C36.2089 37.1568 35.6362 36.7477 34.9983 36.4688C34.3604 36.1899 33.6712 36.0473 32.9749 36.0501H26.8999C26.2037 36.0473 25.5145 36.1899 24.8766 36.4688C24.2386 36.7477 23.666 37.1568 23.1953 37.6699C22.7246 38.183 22.3662 38.7887 22.1432 39.4482C21.9201 40.1078 21.8373 40.8067 21.8999 41.5001L23.2749 53.7751C23.428 54.9901 24.0216 56.1067 24.9432 56.9131C25.8648 57.7195 27.0504 58.1597 28.2749 58.1501H31.7499C32.9745 58.1597 34.16 57.7195 35.0817 56.9131C36.0033 56.1067 36.5969 54.9901 36.7499 53.7751L37.9749 41.5001Z"
                            stroke="url(#paint2_linear_52_683)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M30 31.2251C33.3827 31.2251 36.125 28.4828 36.125 25.1001C36.125 21.7174 33.3827 18.9751 30 18.9751C26.6173 18.9751 23.875 21.7174 23.875 25.1001C23.875 28.4828 26.6173 31.2251 30 31.2251Z"
                            stroke="url(#paint3_linear_52_683)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <defs>
                            <linearGradient id="paint0_linear_52_683" x1="44.375" y1="10.4824" x2="13.1892"
                                y2="14.7658" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint1_linear_52_683" x1="53.3251" y1="1.93213" x2="2.62359"
                                y2="8.3016" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint2_linear_52_683" x1="37.9952" y1="36.05" x2="20.2887"
                                y2="37.4082" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                            <linearGradient id="paint3_linear_52_683" x1="36.125" y1="18.9751" x2="22.7346"
                                y2="20.3836" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FF9211" />
                                <stop offset="1" stop-color="#FF1111" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <p>
                        Join the league of successful bloggers and content creators who have chosen «Top Audio»
                        to enhance their projects with the same music trusted by global titans.
                    </p>
                </li>
            </ul>
        </div>
    </section>
@endsection
