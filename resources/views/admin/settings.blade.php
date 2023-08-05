@extends('layout.admin.index')

@section('html')
    <h2>Настройки</h2>
    <form class="admin-form" action="{{ url()->current() }}" method="post">
        @csrf
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Путь к лого*</span>
                <input class="admin-input" type="text" name="logo" value="{{ old('logo') ?? $site->logo }}" required>
                @error('logo')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Путь к иконке</span>
                <input class="admin-input" type="text" name="favicon" value="{{ old('favicon') ?? $site->favicon }}">
                @error('favicon')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Название*</span>
                <input class="admin-input" type="text" name="name" value="{{ old('name') ?? $site->name }}" required>
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
                <input class="admin-input" type="email" name="email" value="{{ old('email') ?? $site->email }}">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Адрес</span>
                <input class="admin-input" type="text" name="address" value="{{ old('address') ?? $site->address }}">
                @error('address')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <div class="admin-form__flex">
            <label class="admin-label">
                <span>Количество отображений в админке</span>
                <input class="admin-input" type="text" name="count_admin"
                    value="{{ old('count_admin') ?? $site->count_admin }}">
                @error('count_admin')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label">
                <span>Количество отображений у пользователей</span>
                <input class="admin-input" type="text" name="count_front"
                    value="{{ old('count_front') ?? $site->count_front }}">
                @error('count_front')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <button class="admin-button">Сохранить</button>
    </form>
    <br>
    <h2>FAQ</h2>
    <div class="admin-form">
        <form class="admin-form__flex aling-items-end" action="{{ route('faq.create') }}" method="post">
            @csrf
            <label class="admin-label">
                <span>Вопрос</span>
                <input class="admin-input" type="text" name="question">
                @error('question')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <label class="admin-label admin-form__flex_long">
                <span>Ответ</span>
                <textarea class="admin-input" name="answer" rows="1"></textarea>
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
                    <input class="admin-input" type="text" value="{{ $faq_item->question }}" disabled>
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
                <div>
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
    <br>
    <h2>Слайдер</h2>
    <div class="admin-form">
        <h3>Настройки слайдера</h3>
        <form class="admin-form" action="{{ route('slider.setting') }}">
            @csrf
            <label class="admin-label">
                <span>Изображение слайдера</span>
                <input class="admin-input" type="file" name="bg_image">
                @error('bg_image')
                    <span class="error">{{ $message }}</span>
                @enderror
            </label>
            <div class="admin-form__flex">
                <label class="admin-label">
                    <span>Количество лого при больше 1440px</span>
                    <input class="admin-input" type="number" name="count-slide-1440">
                    @error('count-slide-1440')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="admin-label">
                    <span>Количество лого при больше 768px</span>
                    <input class="admin-input" type="number" name="count-slide-768">
                    @error('count-slide-768')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="admin-label">
                    <span>Количество лого при больше 400px</span>
                    <input class="admin-input" type="number" name="count-slide-400">
                    @error('count-slide-400')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
                <label class="admin-label">
                    <span>Количество лого при меньше 400px</span>
                    <input class="admin-input" type="number" name="count-slide-min">
                    @error('count-slide-min')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
            </div>
        </form>
        <h3>Слайды</h3>
        <form class="admin-form__flex aling-items-end" action="{{ route('slide.create') }}" method="post">
            @csrf
            <label class="admin-label">
                <span>Картинка</span>
                <input class="admin-input" type="file" name="image">
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
                <button class="admin-button">Создать</button>
            </span>
        </form>
    </div>
@endsection
