@extends('layout.front.index')

@section('php')
    @php
        // $playlist = App\Http\Controllers\FrontMusicController::getById($id);
        $playlist = App\Models\Playlist::findOrFail($id);
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
                                data-src="{{ App\Http\Controllers\ImageController::getViewImage($playlist->image, null, '/img/playlist.png') }}"
                                alt="">
                        </div>
                    </div>
                    <div class="track__info_text">
                        <h1 class="section-title-big track__title">{{ $playlist->title }}</h1>
                        @if ($playlist->description)
                            <p class="track__description text-medium">{{ $playlist->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="section-main">
            <div class="container">
                <ul class="track__category">
                    <li class="track__category_item category-item">
                        <div class="category-item__name section-title">Genres</div>
                        <ul class="category-item__list">
                            @foreach ($playlist->genres as $genre)
                                <li class="category-item__item">
                                    <a class="category-item__link text-medium" href="/tracks?genre={{ $genre->id }}">
                                        {{ $genre->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="track__category_item category-item">
                        <div class="category-item__name section-title">Moods</div>
                        <ul class="category-item__list">
                            @foreach ($playlist->moods as $mood)
                                <li class="category-item__item">
                                    <a class="category-item__link text-medium" href="/tracks?mood={{ $mood->id }}">
                                        {{ $mood->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tracks section-main">
            <div class="container">
                <h2 class="section-title tracks__title">Tracks</h2>
                <x-tracks_list :music_list="[...$playlist->music]" />
            </div>
    </section>
@endsection
