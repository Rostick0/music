@include('layout.head')
@vite(['resources/scss/admin/index.scss'])

<div class="admin-wrapper">
    @include('aside.client_aside')
    <div class="admin-content">
        <div class="admin-content__top">
            <a class="admin-content__top_item" href="{{ route('client.profile.edit') }}">личный кабинет</a>
            <a class="admin-content__top_item" href="{{ route('logout') }}">Выход</a>
        </div>
        <div class="admin-content__inner">
            @yield('html')
        </div>
    </div>
</div>

@include('layout.footer')
