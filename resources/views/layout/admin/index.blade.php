@include('layout.head')
@vite(['resources/scss/admin/index.scss'])

<div class="admin-wrapper">
    @include('aside.admin_aside')
    <div class="admin-content">
        <div class="admin-content__top">
            <div class="admin-content__burger">
                <span></span>
            </div>
            <a class="admin-content__top_item" href="{{ route('notices') }}">
                <span>Уведомления</span>
                <span class="admin-content__top_alert">
                    @php
                        $count = App\Models\Notice::where('is_read', 0)->count();
                    @endphp
                    @if ($count > 0)
                        <span class="admin-content__top_alert_count">{{ $count }}</span>
                    @endif
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#fff"
                        viewBox="0 0 16 16">
                        <path
                            d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9.06 9.06 0 0 0 8 15z" />
                    </svg>
                </span>
            </a>
            <a class="admin-content__top_item" href="{{ route('admin.profile.edit') }}">Личный кабинет</a>
            <a class="admin-content__top_item" href="{{ route('logout') }}">Выход</a>
        </div>
        <div class="admin-content__inner">
            @yield('html')
        </div>
    </div>
</div>

@php
    $token_controller = new App\Http\Controllers\TokenController();
@endphp

<script>
    const userId = {{ auth()->id() ?? 'null' }};
    const hasSubscription = {{ $has_subscription ?? 'null' }};
    const accessToken = {{ '`' . $token_controller->get() . '`' ?? 'null' }};
</script>

@include('layout.footer')
