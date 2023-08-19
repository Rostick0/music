@props(['music_list'])

@php
    function favorite($favorite_id, $music_item_id)
    {
        if ($favorite_id) return true;
    
        $local_data = json_decode(Cookie::get('favorite'));

        if (!is_array($local_data)) return false;

        $object = (object) ['type_id' => $music_item_id, 'type' => 'music'];
    
        return in_array($object, $local_data);
    }
@endphp

<ul class="tracks__list">
    @if (empty($music_list))
        <h3 class="tracks__none">Music not found</h3>
    @else
        @foreach ($music_list as $music_item)
            <x-track_item :music_item="$music_item" />
        @endforeach
    @endif
</ul>
