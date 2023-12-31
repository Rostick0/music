@extends('layout.admin.index')

@section('html')
    <div class="admin-content__inner_gap">

        <form class="admin-form" action="{{ url()->current() }}" method="post">
            @csrf
            <div class="admin-form__flex">
                <label class="admin-label">
                    <span>Name*</span>
                    <input class="admin-input" type="text" name="name" maxlength="255" value="{{ old('name') }}"
                        required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <div class="admin-buttons">
                <button class="admin-button">Save</button>
            </div>
        </form>
        <div>
            <h2 class="admin-content__title">Moods</h2>
            <div class="admin-form">
                @foreach ($mood_list as $mood_item)
                    <div class="admin-form__flex aling-items-end">
                        <label class="admin-label">
                            <span>Name*</span>
                            <input class="admin-input" type="text" value="{{ $mood_item->name }}" disabled required>
                        </label>
                        <div class="admin-buttons">
                            <a class="admin-button"
                                href="{{ route('mood.edit', [
                                    'id' => $mood_item->id,
                                ]) }}">Change</a>
                            <a class="admin-button-red admin-delete__button"
                                href="{{ route('delete_confirm', [
                                    'type' => 'moods',
                                    'type_id' => $mood_item->id,
                                ]) }}">Remove</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
