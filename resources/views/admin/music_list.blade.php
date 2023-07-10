@extends('layout.admin')

@section('html')
<div class="admin-grid">
    <div class="admin-grid__titles admin-grid-music__titles">
        <div>ID</div>
        <div>Название</div>
        <div>Ссылка</div>
        {{-- <div>Демо ссылка</div> --}}
        <div>Жанр</div>
        {{-- <div>Email</div> --}}
        <div>Длительность</div>
        <div>Дата</div>
    </div>
    <ul class="admin-grid__content admin-grid-music__content">
        @foreach ($music_list as $music_item)
            <li class="admin-grid__content_item admin-grid-music__content_item">
                <div>{{ $music_item->id }}</div>
                <div>{{ $music_item->name }}</div>
                <a class="text-ellipsis" title="{{ $music_item->link }}" target="_blank"
                    href="{{ $music_item->link }}">{{ $music_item->link }}</a>
                <div>{{ $music_item->genre_name }}</div>
                <div>{{ $music_item->duration }}</div>
                <div>{{ $music_item->created_at }}</div>
            </li>
        @endforeach
    </ul>
    {{ $music_list->links('vendor.admin-pagination') }}
</div>
@endsection
