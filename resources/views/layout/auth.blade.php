@include('layout.head')
@vite(['resources/scss/admin/index.scss', 'resources/scss/auth/index.scss'])

<div class="auth-wrapper">
    @yield('html')
</div>

@include('layout.footer')
