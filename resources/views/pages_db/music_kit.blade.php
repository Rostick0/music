@extends('layout.front.index')

@section('php')
    @php
        $music_kit = App\Http\Controllers\FrontMusicKitController::getById($id);
        $artist_name = App\Models\MusicArtist::find($music_kit->music_artist_id)->name;
        $music_list = App\Http\Controllers\FrontMusicKitController::getSimilar($music_kit->id);
    @endphp
@endsection


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
                        <div class="track__artist">{{ $artist_name }}</div>
                        @if ($music_kit->description)
                            <p class="track__description text-medium">{{ $music_kit->description }}</p>
                        @endif
                        <p class="track__description text-medium">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                            Nisi libero
                            vitae corrupti id, nobis voluptatibus. Sapiente explicabo molestiae, nobis aperiam illo
                            cupiditate id doloremque esse ipsa, quaerat quibusdam optio alias?</p>
                    </div>
                </div>
                <ul class="track__version">
                    <li class="track__version trakc-version">
                        <div class="track-version__name text-medium">Music kit</div>
                        <div class="track-version__item track-item">
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
                                    {{ App\Http\Controllers\MusicController::normalizeTime($music_kit->duration) }}</div>
                            </div>
                            <div class="track-item__audio track-item__audio_{{ $music_kit->id }}"
                                data-music="/music_kit/{{ $music_kit->link }}"></div>
                            <div class="track-item__buttons">
                                <a class="track-item__download"
                                    href="{{ Storage::url('upload/music_kit/' . $music_kit->link) }}" download>
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
                                        <a class="category-item__link text-medium" href="/tracks?genre={{ $genre->id }}">
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
                                        <a class="category-item__link text-medium" href="/tracks?mood={{ $mood->id }}">
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

        @if (!empty($music->parts))
            <div class="tracks section-main">
                <div class="container">
                    <h2 class="section-title tracks__title">Similar tracks</h2>
                    <ul class="tracks__list">
                        @foreach ($music_list as $music_item)
                            <x-music_kit_list :music_kit_list="[...$music_kit_list]" />
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

    </section>
@endsection
