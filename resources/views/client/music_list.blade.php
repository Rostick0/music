@extends('layout.client.index')

@section('html')
    @vite(['resources/scss/front/index.scss'])

    <section class="section-page tracks">
        <div class="container">
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
                        @foreach (App\Models\Genre::all() as $genre)
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
                        @foreach (App\Models\Mood::all() as $mood)
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
                        @foreach (App\Models\Theme::all() as $theme)
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
                        @foreach (App\Models\Instrument::all() as $instrument)
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
                        <li class="select__item" data-id="">All durations</li>
                        <li class="select__item" data-id="max_time=2:00">Short</li>
                        <li class="select__item" data-id="min_time=2:00&max_time=4:00">Medium</li>
                        <li class="select__item" data-id="min_time=4:00">Long</li>
                    </ul>
                </div>
            </form>
            @php
                $music_controller = new App\Http\Controllers\MusicController();
                $music_list = $music_controller->search($request, '');
            @endphp
            <x-tracks_list :music_list="[...$music_list]" />
            {{ $music_list->appends(Request::all())->links('vendor.front-pagination') }}
    </section>

    <x-player />
    <script src="/js/libs/wavesurfer.js"></script>
    @vite(['resources/js/front.js'])
@endsection
