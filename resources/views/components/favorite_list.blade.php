@props(['music_list'])

<ul class="tracks__list">
    @if (empty($music_list))
        <h3 class="tracks__none">Music not found</h3>
    @else
        @foreach ($music_list as $music_item)
            @if ($music_item->table_type === 'music')
                <x-music_item :music_item="$music_item" type="music" />
            @elseif ($music_item->table_type === 'music_kit')
                <x-music_item :music_item="$music_item" type="music_kit" />
            @elseif ($music_item->table_type === 'muisc_part')
                <x-music_part_item :music_item="$music_item" />
            @endif
        @endforeach
    @endif
</ul>

<script>
    const FavorutePage = true;
</script>