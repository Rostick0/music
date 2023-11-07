@extends('layout.client.index')

@section('html')
    @vite(['resources/scss/front/index.scss'])

    <section class="section-page tracks">
        <div class="container">
            <ul class="tracks__list">
                @foreach ($stories as $story)
                    @if ($story->storysable_type === 'App\Models\Music')
                        <x-music_item :music_item="$story?->storysable" type="music" />
                    @endif
                    @if ($story->storysable_type === 'App\Models\MusicKit')
                        <x-music_item :music_item="$story?->storysable" type="music_kit" />
                    @endif
                @endforeach
            </ul>
            {{ $stories->appends(Request::all())->links('vendor.front-pagination') }}
    </section>

    <x-player />
    <script src="/js/libs/wavesurfer.js"></script>
    @vite(['resources/js/front.js'])
@endsection
