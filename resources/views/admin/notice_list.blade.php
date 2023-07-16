@extends('layout.admin.index')

@section('html')
    <div class="admin-grid">
        <div class="admin-grid__titles admin-grid-notice__titles">
            <div>ID</div>
            <div>Тип</div>
            <div>Ссылка</div>
            <div>Статус</div>
            <div>Имя</div>
            <div>Email</div>
            <div>Музыка</div>
            <div>Дата</div>
        </div>
        <ul class="admin-grid__content admin-grid-notice__content">
            @foreach ($notices as $notice)
                <li
                    class="admin-grid__content_item admin-grid-notice__content_item @if (!$notice->is_read) _active @endif">
                    <div>{{ $notice->id }}</div>
                    <div>{{ $notice->type }}</div>
                    <a class="text-ellipsis" title="{{ $notice->remove_claim_link }}" target="_blank"
                        href="{{ $notice->remove_claim_link }}">{{ $notice->remove_claim_link }}</a>
                    <div>{{ $notice->remove_claim_status }}</div>
                    <div>{{ $notice->user_name }}</div>
                    <div>{{ $notice->user_email }}</div>
                    <a target="_blank" href="{{ $notice->music_id }}">{{ $notice->music_title }}</a>
                    <div>{{ $notice->created_at }}</div>
                </li>
            @endforeach
        </ul>
        {{ $notices->links('vendor.admin-pagination') }}
    </div>
@endsection
