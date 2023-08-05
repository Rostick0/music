@props(['playlist_list'])

@if (empty($playlist_list))
    <h3 class="tracks__none">Playlists not found</h3>
@else
    <div class="playlist__list">
        @foreach ($playlist_list as $playlist_item)
            <a class="playlist__link playlist-item" href="/playlist/{{ $playlist_item->id }}">
                <img class="playlist-item__img lazy" decoding="async" loading="lazy"
                    data-src="{{ App\Http\Controllers\ImageController::getViewImage($playlist_item->image, 'image', '/img/playlist.png') }}"
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
                <div class="playlist-item__title text-big">{{ $playlist_item->title }}</div>
            </a>
        @endforeach
    </div>
@endif
