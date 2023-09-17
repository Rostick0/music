@extends('layout.front.index')

@section('seo_title', $site_page?->seo_title)
@section('seo_description', $site_page?->seo_description)

@section('html')
    <section class="section section-page tracks">
        <div class="container">
            @php
                $music_list = App\Http\Controllers\FavoriteController::getMusic();
            @endphp
            <h2 class="section-title tracks__title">Favorite</h2>
            <x-favorite_list :music_list="[...$music_list]" />
            {{ $music_list->links('vendor.front-pagination') }}
    </section>

    <x-player />

    <x-favorite_modal />
@endsection
