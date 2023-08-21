@props(['music_list'])

@php
    function favorite($favorite_id, $music_item_id)
    {
        return true;
    }
@endphp

<ul class="tracks__list">
    @if (empty($music_list))
        <h3 class="tracks__none">Music not found</h3>
    @else
        @foreach ($music_list as $music_item)
            @if ($music_item->table_type === 'music')
                <x-track_item :music_item="$music_item" />
            @elseif ($music_item->table_type === 'music_kit')
                <x-music_kit_item :music_item="$music_item" />
            @elseif ($music_item->table_type === 'muisc_part')
                <x-music_part_item :music_item="$music_item" />
            @endif
        @endforeach
    @endif
</ul>
