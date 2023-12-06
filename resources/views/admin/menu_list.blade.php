@extends('layout.admin.index')

@section('html')
    <div class="admin-content__inner_gap">
        <form class="admin-form" action="{{ url()->current() }}" method="post">
            @csrf
            <div class="admin-form__flex">
                <label class="admin-label">
                    <span>Page name*</span>
                    <input class="admin-input" type="text" name="name" maxlength="255" value="{{ old('name') }}"
                        required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="admin-label">
                    <span>Page*</span>
                    <select class="admin-input" name="site_page_id" required style="margin: 10px 0!important;">
                        <option value="" hidden>Select</option>
                        @foreach ($page_list as $page_item)
                            <option value="{{ $page_item->id }}">{{ $page_item->name }}</option>
                        @endforeach
                    </select>
                    @error('site_page_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="admin-label">
                    <span>Order*</span>
                    <input class="admin-input" type="number" name="order" value="{{ old('order') }}" required>
                    @error('order')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <div class="admin-buttons">
                <button class="admin-button">Save</button>
            </div>
        </form>
        <div class="">
            <h2 class="admin-content__title">Menu</h2>
            <div class="admin-form">
                @foreach ($menu_list as $menu_item)
                    <div class="admin-form__flex aling-items-end">
                        <label class="admin-label">
                            <span>Page name*</span>
                            <input class="admin-input" type="text" value="{{ $menu_item->name }}" disabled required>
                        </label>
                        <label class="admin-label">
                            <span>Page*</span>
                            <input class="admin-input" type="text" value="{{ $menu_item->page->name }}" disabled
                                required>
                        </label>
                        <label class="admin-label">
                            <span>Order*</span>
                            <input class="admin-input" type="text" value="{{ $menu_item->order }}" disabled required>
                        </label>
                        <div class="admin-buttons">
                            <a class="admin-button"
                                href="{{ route('menu.edit', [
                                    'id' => $menu_item->id,
                                ]) }}">Change</a>
                            <form
                                action="{{ route('menu.delete', [
                                    'id' => $menu_item->id,
                                ]) }}"
                                method="post">
                                @csrf
                                <button class="admin-button-red">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
