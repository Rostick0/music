@extends('layout.front.index')

@section('php')
    @php
        // $playlists = App\Models\Playlist::limit(6)->orderByDesc('id')->get();
        $music_list = App\Http\Controllers\FavoriteController::getMusic();
    @endphp
@endsection


@section('html')
    <section class="section section-page tracks">
        <div class="container">
            <h2 class="section-title tracks__title">Favorite</h2>
            <x-tracks_list :music_list="[...$music_list]" />
    </section>
@endsection
