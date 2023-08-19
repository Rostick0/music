@php
    $config_slider = App\Http\Controllers\SliderSettingController::get();
    $slides = App\Models\Slide::all();
@endphp
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

<section class="banner-main lazy"
    data-bg="{{ App\Http\Controllers\ImageController::getViewImage($config_slider->bg_image) }}">
    <div class="container">
        <h1 class="banner-main__title">{{ $config_slider->slider_title }}</h1>
        <div class="banner-main__description text-medium">{{ $config_slider->slider_description }}</div>
        <div class="banner-main__buttons">
            <a class="button-gradient banner-main__button" href="{{$config_slider->button_first_link}}">{{ $config_slider->button_first_text }}</a>
            <a class="button-white banner-main__button" href="{{$config_slider->button_second_link}}">{{ $config_slider->button_second_text }}</a>
        </div>
        <div class="banner-main__slider mySwiper swipper">
            <div class="swiper-wrapper">
                @foreach ($slides as $slide)
                    <div class="swiper-slide">
                        <img class="lazy" decoding="async" loading="lazy"
                            data-src="{{ App\Http\Controllers\ImageController::getViewImage($slide->image, 'slide') }}"
                            width="{{ $slide->width }}" height="{{ $slide->height }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


<script src="/js/libs/swiper.js"></script>
<script defer>
    new Swiper(".mySwiper", {
        breakpoints: {
            1: {
                slidesPerView: {{ $config_slider->count_slide_min }},
            },
            400: {
                slidesPerView: {{ $config_slider->count_slide_400 }},
                spaceBetween: 24,
            },
            768: {
                slidesPerView: 4,
                spaceBetween: {{ $config_slider->count_slide_768 }},
            },
            1440: {
                slidesPerView: 5,
                spaceBetween: {{ $config_slider->count_slide_1440 }},
            }
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
    });
</script>
