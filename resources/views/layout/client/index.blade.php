@include('layout.head')
@vite(['resources/scss/admin/index.scss'])
<script>
    const userAgree = {{ auth()->user()->agree ?? 'null' }};
</script>

<div class="admin-wrapper">
    @include('aside.client_aside')
    <div class="admin-content">
        <div class="admin-content__top">
            <a class="admin-content__top_item" href="{{ route('client.profile_edit') }}">личный кабинет</a>
            <a class="admin-content__top_item" href="{{ route('logout') }}">Выход</a>
        </div>
        <div class="admin-content__inner">
            @yield('html')
        </div>
    </div>
</div>

<div class="modal-agree">
    <div class="modal-agree__inner">
        <div class="modal-agree__title">Пользовательское соглашение</div>
        <div class="modal-agree__description">Пользуясь этим сайтом, вы принимаете ...</div>
        <button class="admin-button modal-agree__button">Согласен</button>
    </div>
</div>

@include('layout.footer')
