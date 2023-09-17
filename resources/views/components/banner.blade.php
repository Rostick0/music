@if (!Auth::check())
    <div class="banner">
        <div class="container">
            <div class="banner__container">
                <div class="banner__container_left">
                    <img src="{{ $banner?->icon }}" width="30" height="30" alt="">
                    <div class="banner__text text-medium">{{ $banner?->text }}</div>
                </div>
                <a href="{{ $banner?->button_link }}" class="button-white banner__link">{{ $banner?->button_text }}</a>
            </div>
        </div>
    </div>
@endif
