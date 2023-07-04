@include('layout.head')


<div class="admin-wrapper">
    <x-admin_aside />
    <div class="admin-content">
        <div class="admin-content__top">
            <a class="admin-content__top_item" href="">
                <span>уведомление</span>
                <span class="admin-content__top_alert">
                    <span class="admin-content__top_alert_count">0</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#fff"
                        viewBox="0 0 16 16">
                        <path
                            d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9.06 9.06 0 0 0 8 15z" />
                    </svg>
                </span>
            </a>
            <div class="admin-content__top_item">личный кабинет</div>
        </div>
        <div class="admin-content__inner">
            @yield('html')
        </div>
    </div>
</div>

@include('layout.footer')
