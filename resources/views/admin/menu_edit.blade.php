@extends('layout.admin.index')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Название*</span>
                <input class="admin-input" type="text" name="name" maxlength="255" value="{{ old('name') ?? $menu->name }}"
                    required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Страница*</span>
                <select class="admin-input" name="site_page_id" required>
                    <option value="" hidden>Выберите</option>
                    @foreach ($page_list as $page_item)
                        <option @if ((old('site_page_id') ?? $page_item->id) == $menu->site_page_id) selected @endif value="{{ $page_item->id }}">
                            {{ $page_item->name }}</option>
                    @endforeach
                </select>
                @error('site_page_id')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Порядок*</span>
                <input class="admin-input" type="number" name="order" value="{{ old('order') ?? $menu->order }}"
                    required>
                @error('order')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-buttons admin-button__margin-top">
            <button class="admin-button">Изменить</button>
        </div>
    </form>
@endsection
