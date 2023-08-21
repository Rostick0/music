@props(['music_kit_list'])

@php
    
@endphp


<ul class="music-kit__list">
    @if (empty($music_kit_list))
        <h3 class="tracks__none">Music kit not found</h3>
    @else
        @foreach ($music_kit_list as $music_item)
            <x-music_kit_item :music_item="$music_item" />
        @endforeach
    @endif
</ul>
