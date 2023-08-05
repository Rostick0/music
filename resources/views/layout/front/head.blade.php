<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/scss/index.scss'])
    <title>@yield('seo_title', $site->seo_title)</title>
    <meta name="description" content="@yield('seo_description', $site->seo_description)">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $token_controller = new App\Http\Controllers\TokenController();
    @endphp
    <script>
        const userId = {{ auth()->id() ?? 'null' }};
        const hasSubscription = {{ $has_subscription ?? 'null' }};
        const accessToken = {{ '`' . $token_controller->get() . '`' ?? 'null' }};
        // {{ '`' . $token_controller->get() . '`' ?? 'null' }};
    </script>
</head>

<body>
    <div class="wrapper">
        <x-banner />

        <header class="header">
            <div class="container">
                <div class="header__container">
                    <div class="header-mobile">
                        <button class="header-mobile__burger">
                            <svg width="27" height="25" viewBox="0 0 27 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 20.3846H25.9136" stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M1 12.6923H25.9136" stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M1 5H25.9136" stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                        <div class="header-mobile__modal">
                            <div class="container header-mobile__modal_container">
                                <div class="header-mobile__modal_top">
                                    <button class="header-mobile__close">
                                        <svg width="27" height="25" viewBox="0 0 27 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 20.3846H25.9136" stroke="#1B121E" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M1 12.6923H25.9136" stroke="#1B121E" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M1 5H25.9136" stroke="#1B121E" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <a class="header-mobile__logo" href="/">
                                        <img src="{{ $site->logo }}" alt="">
                                    </a>
                                </div>
                                <nav class="header-mobile__nav">
                                    <a class="header-mobile__nav_item" href="/">Home</a>
                                    <a class="header-mobile__nav_item" href="/tracks">Tracks</a>
                                    <a class="header-mobile__nav_item" href="/playlists">Playlists</a>
                                    <a class="header-mobile__nav_item" href="/music_kits">Music kits</a>
                                    <a class="header-mobile__nav_item" href="/pricing">Pricing</a>
                                    <a class="header-mobile__nav_item" href="/about">About</a>
                                    <a class="header-mobile__nav_item" href="/contacts">Contacts</a>
                                </nav>
                                <a class="button-gradient header-mobile__sing-in" href="/login">Sign in</a>
                            </div>
                        </div>
                    </div>
                    <a class="header__logo" href="/">
                        <img src="{{ $site->logo }}" alt="">
                    </a>
                    <nav class="header__nav">
                        <a class="header__nav_item" href="/">Home</a>
                        <a class="header__nav_item" href="/tracks">Tracks</a>
                        <a class="header__nav_item" href="/playlists">Playlists</a>
                        <a class="header__nav_item" href="/music_kits">Music kits</a>
                        <a class="header__nav_item" href="/pricing">Pricing</a>
                        <a class="header__nav_item" href="/about">About</a>
                        <a class="header__nav_item" href="/contacts">Contacts</a>
                    </nav>
                    <a class="header__favorite" href="/favorite">
                        @php
                            $count_favorite = App\Http\Controllers\FavoriteController::countMy();
                        @endphp
                        @if ($count_favorite)
                            <div class="header__favorite_count">{{ $count_favorite }}</div>
                        @endif
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_52_186)">
                                <path
                                    d="M15.9114 1.49999L20.0939 9.78624L28.1439 10.5837C28.3355 10.5997 28.5186 10.6702 28.6714 10.7869C28.8242 10.9036 28.9404 11.0617 29.0061 11.2424C29.0719 11.4231 29.0845 11.6189 29.0424 11.8066C29.0004 11.9942 28.9054 12.1659 28.7689 12.3012L22.1439 18.8675L24.6001 27.79C24.6504 27.9792 24.6449 28.179 24.5843 28.3652C24.5237 28.5514 24.4106 28.7161 24.2587 28.8396C24.1067 28.9631 23.9223 29.04 23.7276 29.0611C23.5329 29.0823 23.3363 29.0467 23.1614 28.9587L15.0001 24.9175L6.85012 28.9537C6.67518 29.0417 6.47855 29.0773 6.28388 29.0561C6.08921 29.035 5.9048 28.9581 5.75281 28.8346C5.60083 28.7111 5.48775 28.5464 5.42717 28.3602C5.3666 28.174 5.36111 27.9742 5.41137 27.785L7.86762 18.8625L1.23762 12.2962C1.10103 12.1609 1.00609 11.9892 0.964047 11.8016C0.921999 11.6139 0.934601 11.4181 1.00036 11.2374C1.06612 11.0567 1.18228 10.8986 1.3351 10.7819C1.48791 10.6652 1.67098 10.5947 1.86262 10.5787L9.91261 9.78124L14.0889 1.49999C14.1748 1.33224 14.3053 1.19145 14.4661 1.09314C14.6269 0.994831 14.8117 0.94281 15.0001 0.94281C15.1886 0.94281 15.3734 0.994831 15.5342 1.09314C15.6949 1.19145 15.8255 1.33224 15.9114 1.49999Z"
                                    stroke="url(#paint0_linear_52_186)" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>
                            <defs>
                                <linearGradient id="paint0_linear_52_186" x1="29.0668" y1="0.94281"
                                    x2="-1.67865" y2="4.17713" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#FF9211" />
                                    <stop offset="1" stop-color="#FF1111" />
                                </linearGradient>
                                <clipPath id="clip0_52_186">
                                    <rect width="30" height="30" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    <a class="button-gradient header__sing-in" href="/login">Sign in</a>
                </div>
            </div>
        </header>

        <main class="main">
