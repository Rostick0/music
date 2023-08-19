@extends('layout.front.index')

@section('php')
    @php
        $music_list = App\Http\Controllers\FavoriteController::getMusic();
    @endphp
@endsection


@section('html')
    <section class="section section-page tracks">
        <div class="container">
            <h2 class="section-title tracks__title">Favorite</h2>
            {{-- @dd($music_list) --}}
            <x-favorite_list :music_list="[...$music_list]" />
    </section>
@endsection
