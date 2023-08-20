@extends('layout.admin.index')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Название*</span>
                <input class="admin-input" type="text" name="name" maxlength="255"
                    value="{{ old('name') ?? $subscription_type->name }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Цена*</span>
                <input class="admin-input" type="number" step="0.01" name="price" maxlength="255"
                    value="{{ old('price') ?? $subscription_type->price }}" required>
                @error('price')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Описание</span>
                <textarea class="admin-input" name="description" rows="3" maxlength="65536">{{ old('description') ?? $subscription_type->description }}</textarea>
                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Преимущества</span>
                <textarea class="admin-input" name="advantages" rows="3" maxlength="65536">{{ old('advantages') ?? $subscription_type->advantages }}</textarea>
                @error('advantages')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-checkbox">
                <input class="admin-checkbox__input" type="checkbox" name="is_active"
                    {{ old('is_active') ?? $subscription_type->is_active ? 'checked' : '' }}>
                <span class="admin-checkbox__icon"></span>
                <span>Активен?</span>
            </label>
        </div>
        <div class="admin-delete__buttons admin-button__margin-top">
            <button class="admin-button">Изменить</button>
        </div>
    </form>
    <br>
    <form action="{{ route('subscription_type.delete', ['id' => $subscription_type->id]) }}" method="post">
        @csrf
        <button class="admin-button-red">Удалить</button>
    </form>
@endsection
