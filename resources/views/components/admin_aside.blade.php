<aside class="admin-aside">
    <div class="admin-aside__logo">
        <img src="{{ ($site->logo) }}" alt="">
    </div>
    <nav class="admin-aside__nav">
        <ul class="admin-aside__navigation">
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'music' ? ' _active' : '' }}"
                    href="{{ route('music.list') }}">Треки</a>
            </li>
            <li class="admin-aside__navigation_item{{ Request::segment(2) === 'music.create' ? ' _active' : '' }}">
                <a class="admin-aside__navigation_link" href="{{ route('music.create') }}">Треки music kit</a>
            </li>
            <li class="admin-aside__navigation_item{{ Request::segment(2) === 'playlist' ? ' _active' : '' }}">
                <a class="admin-aside__navigation_link" href="{{ route('playlist') }}">Плейлист</a>
            </li>
            <li class="admin-aside__navigation_item{{ Request::segment(2) === 'statistic' ? ' _active' : '' }}">
                <a class="admin-aside__navigation_link" href="{{ route('statistic') }}">Статистика</a>
            </li>
            <li class="admin-aside__navigation_item{{ Request::segment(2) === 'subscriptions' ? ' _active' : '' }}">
                <a class="admin-aside__navigation_link" href="{{ route('subscriptions') }}">Подписки</a>
            </li>
            <li class="admin-aside__navigation_item{{ Request::segment(2) === 'users' ? ' _active' : '' }}">
                <a class="admin-aside__navigation_link" href="{{ route('user.list') }}">Клиенты</a>
            </li>
            <li class="admin-aside__navigation_item{{ Request::segment(2) === 'page' ? ' _active' : '' }}">
                <a class="admin-aside__navigation_link" href="{{ route('page.list') }}">Страницы</a>
            </li>
            <li class="admin-aside__navigation_item{{ Request::segment(2) === 'settings' ? ' _active' : '' }}">
                <a class="admin-aside__navigation_link" href="{{ route('settings') }}">Настройки</a>
            </li>
        </ul>
    </nav>
</aside>
