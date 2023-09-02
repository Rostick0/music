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
            <x-favorite_list :music_list="[...$music_list]" />
    </section>

    <x-player />

    @if (!auth()->check() && Cookie::get('favorite_agree'))
        <div class="modal modal-favorite _active">
            <div class="modal modal-favorite__inner">
                <div class="modal modal-favorite__title">Warning</div>
                <div class="modal modal-favorite__description">Without registration, the list of favorite tracks can be reset
                    to zero</div>
                <button class="admin-button modal-favorite__button">Agree</button>
            </div>
        </div>
    @endif
@endsection
