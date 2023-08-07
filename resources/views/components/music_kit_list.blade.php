@props(['music_kit_list'])

<ul class="music-kit__list">
    @if (empty($music_kit_list))
        <h3 class="tracks__none">Music kit not found</h3>
    @else
        @foreach ($music_kit_list as $music_item)
            <li class="tracks__item track-item">
                <a class="track-item__info" href="/music_kit/{{ $music_item->id }}">
                    <img class="track-item__img lazy"
                        data-src="{{ App\Http\Controllers\ImageController::getViewImage($music_item->music_image) }}"
                        alt="{{ $music_item->title }}">
                    <div class="track-item__text text-ellipsis">
                        <div class="track-item__name">{{ $music_item->name }}</div>
                        <div class="track-item__artist">{{ $music_item->music_artist_name }}</div>
                    </div>
                </a>
                <div class="track-item__timer">
                    <button class="track-button track-item__button">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect width="40" height="40" rx="20" fill="url(#paint0_linear_111_2751)" />
                            <g class="track-item__button_start">
                                <path
                                    d="M15 25.509C15.0004 25.9876 15.1322 26.4559 15.3798 26.8581C15.6273 27.2602 15.9801 27.5793 16.3961 27.7771C16.812 27.9749 17.2735 28.0431 17.7254 27.9735C18.1774 27.904 18.6006 27.6996 18.9447 27.3849L27 20.0032L18.9447 12.6169C18.6008 12.3015 18.1775 12.0966 17.7254 12.0267C17.2732 11.9568 16.8114 12.0249 16.3952 12.2228C15.979 12.4207 15.6261 12.7401 15.3787 13.1426C15.1312 13.5452 14.9998 14.014 15 14.4928V25.509Z"
                                    fill="white" />
                            </g>
                            <g class="track-item__button_pause">
                                <path d="M15.9998 13.6665V27.0002" stroke="white" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M24 13.6665V27.0002" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>
                            <defs>
                                <linearGradient id="paint0_linear_111_2751" x1="40" y1="0" x2="-3.72369"
                                    y2="4.59913" gradientUnits="userSpaceOnUse">
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
                    data-music="{{ '/music_kit/' . $music_item->link }}" data-title="{{ $music_item->music_title }}"
                    data-artist="{{ $music_item->music_artist_name }}"
                    data-time="{{ App\Http\Controllers\MusicController::normalizeTime($music_item->duration) }}">
                </div>
                <div class="track-item__buttons">
                    <a class="track-item__download"
                        href="{{ App\Http\Controllers\MusicDownloadController::getLink($music_item->link, $music_item->link_demo, 1) }}"
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
                                    <rect width="20" height="20" fill="white" transform="translate(10 10)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                </div>
            </li>
        @endforeach
    @endif
</ul>
