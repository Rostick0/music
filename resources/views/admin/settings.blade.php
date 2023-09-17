@extends('layout.admin.index')

@section('html')
    <div class="admin-content__inner_gap">
        <div>
            <div class="tabs">
                <ul class="tabs__caption">
                    <li class="active tab" id="main">Главное</li>
                    <li class="tab" id="slider">FAQ</li>
                    <li class="tab" id="faq">Слайдер</li>
                    <li class="tab" id="sliderlogo">Слайдер лого</li>
                    <li class="tab" id="banner">Баннер</li>
                </ul>
                <div class="tabs__content block main active">
                    <h2 class="admin-content__title">Настройки</h2>
                    <form class="admin-form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="admin-form__flex">
                            <label class="admin-label">
                                <span>Лого*</span>
                                <span class="admin-file-upload">
                                    <input class="admin-file-upload__input" type="file" name="logo"
                                        accept="image/png, image/gif, image/jpeg, image/svg+xml"
                                        value="{{ old('logo') ?? $site->logo }}">
                                    <span class="admin-input">
                                        <span
                                            class="admin-file-upload__name">{{ $site->logo ? 'Загружено' : 'Загрузить файл' }}</span>
                                    </span>

                                </span>
                                @error('logo')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                <img src="{{ old('logo') ?? $site->logo }}" class="adminimg">
                            </label>
                            <label class="admin-label">
                                <span>Иконка</span>
                                <span class="admin-file-upload">
                                    <input class="admin-file-upload__input" type="file"
                                        name="favicon"accept="image/png, image/gif, image/jpeg, image/svg+xml"
                                        value="{{ old('favicon') ?? $site->favicon }}">
                                    <span class="admin-input">
                                        <span
                                            class="admin-file-upload__name">{{ $site->favicon ? 'Загружено' : 'Загрузить файл' }}</span>
                                    </span>
                                </span>
                                @error('favicon')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                <img src="{{ old('favicon') ?? $site->favicon }}" class="adminimg2">
                            </label>
                            <label class="admin-label">
                                <span>Название сайта*</span>
                                <input class="admin-input" type="text" name="name"
                                    value="{{ old('name') ?? $site->name }}" required>
                                @error('name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                        <div class="admin-form__flex">
                            <label class="admin-label">
                                <span>seo title</span>
                                <input class="admin-input" type="text" name="seo_title"
                                    value="{{ old('seo_title') ?? $site->seo_title }}">
                                @error('seo_title')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="admin-label admin-form__flex_long">
                                <span>seo description</span>
                                <textarea class="admin-input" name="seo_description" rows="1">{{ old('seo_description') ?? $site->seo_description }}</textarea>
                                @error('seo_description')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                        <div class="admin-form__flex">
                            <label class="admin-label">
                                <span>Эл. почта</span>
                                <input class="admin-input" type="email" name="email"
                                    value="{{ old('email') ?? $site->email }}">
                                @error('email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="admin-label">
                                <span>Адрес</span>
                                <input class="admin-input" type="text" name="address"
                                    value="{{ old('address') ?? $site->address }}">
                                @error('address')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                        <div class="admin-form__flex">
                            <label class="admin-label">
                                <span>Количество отображений в админке</span>
                                <input class="admin-input" type="number" name="count_admin"
                                    value="{{ old('count_admin') ?? $site->count_admin }}">
                                @error('count_admin')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="admin-label">
                                <span>Количество отображений у пользователей</span>
                                <input class="admin-input" type="number" name="count_front"
                                    value="{{ old('count_front') ?? $site->count_front }}">
                                @error('count_front')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                        <div class="admin-label">
                            <span>Пользовательское соглашение</span>
                            <textarea class="summernote" name="user_policy" id="user_policy">{{ old('user_policy') ?? $site->user_policy }}</textarea>
                            @error('user_policy')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="admin-button__margin-top">
                            <button class="admin-button">Сохранить</button>
                        </div>
                    </form>
                </div>
                <div class="tabs__content block faq">
                    <h2 class="admin-content__title">FAQ</h2>
                    <div class="admin-form">
                        <form class="admin-form__flex aling-items-end" action="{{ route('faq.create') }}" method="post">
                            @csrf
                            <label class="admin-label">
                                <span>Вопрос</span>
                                <input class="admin-input" type="text" name="question"
                                    value="{{ old('question') }}">
                                @error('question')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="admin-label admin-form__flex_long">
                                <span>Ответ</span>
                                <textarea class="admin-input" name="answer" rows="1">{{ old('answer') }}</textarea>
                                @error('answer')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </label>
                            <span>
                                <button class="admin-button">Создать</button>
                            </span>
                        </form>
                        @foreach ($faq_list as $faq_item)
                            <div class="admin-form__flex aling-items-end">
                                <label class="admin-label">
                                    <span>Вопрос</span>
                                    <input class="admin-input" type="text" value="{{ $faq_item->question }}"
                                        disabled>
                                    @error('question')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label class="admin-label admin-form__flex_long">
                                    <span>Ответ</span>
                                    <textarea class="admin-input" rows="1" disabled>{{ $faq_item->answer }}</textarea>
                                    @error('answer')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </label>
                                <div class="admin-buttons">
                                    <a class="admin-button"
                                        href="{{ route('faq.edit', ['id' => $faq_item->id]) }}">Изменть</a>
                                    <form
                                        action="{{ route('faq.delete', [
                                            'id' => $faq_item->id,
                                        ]) }}"
                                        method="post">
                                        @csrf
                                        <button class="admin-button-red">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tabs__content block slider">
                    <h2 class="admin-content__title">Слайдер</h2>
                    <div class="admin-form">
                        <h3>Настройки слайдера</h3>
                        <form class="admin-form" action="{{ route('slider.setting') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label class="admin-label">
                                    <span>Изображение слайдера</span>
                                    <span class="admin-file-upload">
                                        <input class="admin-file-upload__input" type="file" name="bg_image"
                                            accept="image/png, image/gif, image/jpeg">
                                        <span class="admin-input">
                                            <span class="admin-file-upload__name">Загружен</span>
                                        </span>
                                    </span>
                                    @error('bg_image')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </label>
                                <br>
                                <img class="lazy" width="100%"
                                    data-src="{{ App\Http\Controllers\ImageController::getViewImage($slider_config->bg_image) }}"
                                    alt="">
                            </div>
                            <div class="admin-form__flex">
                                <label class="admin-label">
                                    <span>Заголовок слайдера</span>
                                    <input class="admin-input" value="{{ $slider_config->slider_title }}" type="text"
                                        name="slider_title">
                                    @error('slider_title')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label class="admin-label">
                                    <span>Заголовок слайдера</span>
                                    <input class="admin-input" value="{{ $slider_config->slider_description }}"
                                        type="text" name="slider_description">
                                    @error('slider_description')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="admin-form__flex">
                                <label class="admin-label">
                                    <span>Текст первой кнопки</span>
                                    <input class="admin-input" value="{{ $slider_config->button_first_text }}"
                                        type="text" name="button_first_text">
                                    @error('button_first_text')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label class="admin-label">
                                    <span>Ссылка первой кнопки</span>
                                    <input class="admin-input" value="{{ $slider_config->button_first_link }}"
                                        type="text" name="button_first_link">
                                    @error('button_first_link')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label class="admin-label">
                                    <span>Текст второй кнопки</span>
                                    <input class="admin-input" value="{{ $slider_config->button_second_text }}"
                                        type="text" name="button_second_text">
                                    @error('button_second_text')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label class="admin-label">
                                    <span>Ссылка второй кнопки</span>
                                    <input class="admin-input" value="{{ $slider_config->button_second_link }}"
                                        type="text" name="button_second_link">
                                    @error('button_second_link')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="admin-form__flex">
                                <label class="admin-label">
                                    <span>Количество лого при больше 1440px</span>
                                    <input class="admin-input" value="{{ $slider_config->count_slide_1440 }}"
                                        type="number" name="count_slide_1440">
                                    @error('count_slide_1440')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label class="admin-label">
                                    <span>Количество лого при больше 768px</span>
                                    <input class="admin-input" value="{{ $slider_config->count_slide_768 }}"
                                        type="number" name="count_slide_768">
                                    @error('count_slide_768')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label class="admin-label">
                                    <span>Количество лого при больше 400px</span>
                                    <input class="admin-input" value="{{ $slider_config->count_slide_400 }}"
                                        type="number" name="count_slide_400">
                                    @error('count_slide_400')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label class="admin-label">
                                    <span>Количество лого при меньше 400px</span>
                                    <input class="admin-input" value="{{ $slider_config->count_slide_min }}"
                                        type="number" name="count_slide_min">
                                    @error('count_slide_min')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="admin-button__margin-top">
                                <button class="admin-button">Изменить</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tabs__content block sliderlogo">
                    <div>
                        <h3>Логотипы</h3>
                        <form class="admin-form__flex aling-items-end" action="{{ route('slide.create') }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <label class="admin-label">
                                <span>Название</span>
                                <input class="admin-input" type="text" name="name_slide">
                                @error('name_slide')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="admin-label">
                                <span>Картинка</span>
                                <input class="admin-input" type="file" name="image"
                                    accept="image/png, image/gif, image/jpeg">
                                @error('image')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="admin-label">
                                <span>Ширина</span>
                                <input class="admin-input" type="text" name="width">
                                @error('width')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="admin-label">
                                <span>Высота</span>
                                <input class="admin-input" type="text" name="height">
                                @error('height')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </label>
                            <span>
                                <button class="admin-button" style="position: relative;top:-16px;">Создать</button>
                            </span>
                        </form>
                    </div>
                    <ul class="admin-form__slides">
                        @foreach ($slide_list as $slide_item)
                            <li class="admin-form__flex admin-form__slides_item">
                                <label class="admin-label">
                                    <span>Название</span>
                                    <input class="admin-input" type="text" value="{{ $slide_item->name }}" disabled>
                                </label>
                                <img src="{{ App\Http\Controllers\ImageController::getViewImage($slide_item->image, 'slide') }}"
                                    alt="">
                                <form class="admin-form__slides_form"
                                    action="{{ route('slide.delete', [
                                        'id' => $slide_item->id,
                                    ]) }}"
                                    method="post">
                                    @csrf
                                    <button class="admin-button-red">Удалить</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tabs__content block banner">
                    <h3>Баннер</h3>
                    <form class="admin-form__flex aling-items-end" action="{{ route('banner.edit') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <label class="admin-label">
                            <span>Текст баннера</span>
                            <input class="admin-input" type="text" name="text">
                            @error('text')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </label>
                        <label class="admin-label">
                            <span>Картинка</span>
                            <input class="admin-input" type="file" name="icon"
                                accept="image/png, image/gif, image/jpeg, image/svg">
                            @error('icon')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </label>
                        <label class="admin-label">
                            <span>Текст кнопки</span>
                            <input class="admin-input" type="text" name="button_text">
                            @error('button_text')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </label>
                        <label class="admin-label">
                            <span>Ссылка кнопки</span>
                            <input class="admin-input" type="text" name="button_link">
                            @error('button_link')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </label>
                        <span>
                            <button class="admin-button" style="position: relative;top:-16px;">Сохранить</button>
                        </span>
                    </form>
                </div>
            </div>

            <x-summernote_links></x-summernote_links>
        </div>
    </div>
@endsection
