@include('layout.head')
@vite(['resources/scss/admin/index.scss'])

<div class="admin-wrapper">
    <x-client_aside />
    <div class="admin-content">
        <div class="admin-content__top">
            <div class="admin-content__top_item">личный кабинет</div>
        </div>
        <div class="admin-content__inner">
            @yield('html')
        </div>
    </div>
</div>

@include('layout.footer')
