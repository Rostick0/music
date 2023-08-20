@extends('layout.admin.index')

@section('html')
    <form class="admin-delete" action="{{ route($type . '.delete', [
        'id' => $type_id,
    ]) }}" method="post">
        @csrf
        <div class="text-center big-text admin-delete__title">
            <strong>Вы уверены, что хотите удалить?</strong>
        </div>
        <div class="admin-delete__info">
            {{ $type_ru }}
            <a class="text-underline" target="_blank"
                href="{{ route($type . '.edit', [
                    'id' => $type_id,
                ]) }}">{{ $data->title ?? ($data->email ?? $data->name) }}</a>
        </div>
        <div class="admin-delete__buttons admin-button__margin-top">
            <button class="admin-button">Удалить</button>
            <a class="admin-button-red" href="javascript:history.back()">Отмена</a>
        </div>
    </form>
@endsection
