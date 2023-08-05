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
    <section class="section-page tracks">
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
                        <li class="select__item" data-id="">None</li>
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
                        <li class="select__item" data-id="">None</li>
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
                        <li class="select__item" data-id="">None</li>
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
                        <li class="select__item" data-id="">None</li>
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
                        <li class="select__item" data-id="">None</li>
                        <li class="select__item"></li>
                    </ul>
                </div>
            </form>
            <x-tracks_list :music_list="[...$music_list]" />
    </section>
@endsection
