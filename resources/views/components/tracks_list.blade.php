@props(['music_list'])

<ul class="tracks__list">
    @if (empty($music_list))
        <h3 class="tracks__none">Music not found</h3>
    @else
        @foreach ($music_list as $music_item)
            <x-music_item :music_item="$music_item" type="music" />
        @endforeach
    @endif
</ul>
