@props(['music_kit_list'])

@php
    function favorite($favorite_id, $music_item_id)
    {
        if ($favorite_id) {
            return true;
        }
    
        $local_data = json_decode(Cookie::get('favorite'));
    
        if (!is_array($local_data)) {
            return false;
        }
    
        $object = (object) ['type_id' => $music_item_id, 'type' => 'music_kit'];
    
        return in_array($object, $local_data);
    }
@endphp


<ul class="music-kit__list">
    @if (empty($music_kit_list))
        <h3 class="tracks__none">Music kit not found</h3>
    @else
        @foreach ($music_kit_list as $music_item)
            <x-music_kit_item.blade :music_item="$music_item" />
        @endforeach
    @endif
</ul>
