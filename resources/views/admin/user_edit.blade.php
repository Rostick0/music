@extends('layout.admin.index')

@section('html')
    <form class="admin-form" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Name*</span>
                <input class="admin-input" type="text" name="name" maxlength="255" value="{{ old('name') ?? $user->name }}"
                    required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Surname*</span>
                <input class="admin-input" type="text" name="surname" maxlength="255"
                    value="{{ old('surname') ?? $user->surname }}" required>
                @error('surname')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Email*</span>
                <input class="admin-input" type="text" name="email" maxlength="255"
                    value="{{ old('email') ?? $user->email }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Phone</span>
                <input class="admin-input" type="tel" name="telephone" maxlength="255"
                    value="{{ old('telephone') ?? $user->telephone }}">
                @error('telephone')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Date of registration</span>
                <input class="admin-input" type="text" maxlength="255" value="{{ $user->created_at }}" disabled>
            </label>
            <label class="admin-label">
                <span>Subscription start date</span>
                <span class="admin-input">{{ $subscription->created_at ?? '-' }}</span>
            </label>
            <label class="admin-label">
                <span>Subscription end date</span>
                <span class="admin-input">{{ $subscription->date_end ?? '-' }}</span>
            </label>
            <label class="admin-checkbox">
                <input class="admin-checkbox__input" type="checkbox" name="is_auto_renewal"
                    {{ old('is_auto_renewal') ?? ($subscription->is_auto_renewal ?? false) ? 'checked' : '' }} disabled>
                <span class="admin-checkbox__icon"></span>
                <span>Subscription auto-renewal?</span>
            </label>
        </div>
        <div class="admin-delete__buttons admin-button__margin-top">
            <button class="admin-button">Save</button>
            <a class="admin-button-red"
                href="{{ route('delete_confirm', [
                    'type' => 'users',
                    'type_id' => $user->id,
                ]) }}">Remove</a>
        </div>
    </form>
    @if (!empty($remove_claims))
        <div class="admin-remove-claim">
            <h2 class="admin-remove-claim__title">Request on remove claim</h2>
            @foreach ($remove_claims as $remove_claim)
                <ul class="admin-remove-claim__list">
                    <li class="admin-remove-claim__item aling-items-end">
                        <a class="admin-label" target="_blank" href={{ $remove_claim->link }}>
                            <span>Remove claim</span>
                            <span class="admin-input text-ellipsis"
                                title="{{ $remove_claim->link }}">{{ $remove_claim->link }}</span>
                        </a>
                        <label class="admin-label">
                            <span>Date</span>
                            <span class="admin-input">{{ $remove_claim->created_at }}</span>
                        </label>
                        <label class="admin-label">
                            <span>Status</span>
                            <span class="admin-input">{{ $remove_claim->status }}</span>
                        </label>
                        <div class="">
                            <a class="admin-button"
                                href="{{ route('remove_claim.edit', ['id' => $remove_claim->id]) }}">Изменить</a>
                        </div>
                    </li>
                </ul>
            @endforeach
        </div>
    @endif
@endsection
