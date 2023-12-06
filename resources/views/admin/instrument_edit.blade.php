@extends('layout.admin.index')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Name*</span>
                <input class="admin-input" type="text" name="name" maxlength="255"
                    value="{{ old('name') ?? $instrument->name }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-buttons admin-button__margin-top">
            <button class="admin-button">Change</button>
        </div>
    </form>
@endsection
