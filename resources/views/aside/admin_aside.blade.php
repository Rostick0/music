<aside class="admin-aside">
    <div class="admin-aside__top">
        <div class="admin-aside__logo">
            <img src="{{ $site->logo }}" alt="">
        </div>
        <div class="admin-aside__burger-close"></div>
    </div>
    <nav class="admin-aside__nav">
        <ul class="admin-aside__navigation">
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'music' ? ' _active' : '' }}"
                    href="{{ route('music.list') }}">Треки</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'music_kit' ? ' _active' : '' }}" href="{{ route('music_kit.list') }}">Треки music kit</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'playlist' ? ' _active' : '' }}"
                    href="{{ route('playlist') }}">Плейлист</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'statistic' ? ' _active' : '' }}"
                    href="{{ route('statistic') }}">Статистика</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'subscriptions' ? ' _active' : '' }}" href="{{ route('subscriptions') }}">Подписки</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'subscription_type' ? ' _active' : '' }}" href="{{ route('subscription_type.list') }}">Виды подписок</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'users' ? ' _active' : '' }}" href="{{ route('user.list') }}">Клиенты</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'pages' ? ' _active' : '' }}" href="{{ route('page.list') }}">Страницы</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'components' ? ' _active' : '' }}" href="{{ route('component.list') }}">Компоненты</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'settings' ? ' _active' : '' }}" href="{{ route('settings') }}">Настройки</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'menu' ? ' _active' : '' }}" href="{{ route('menu.list') }}">Меню</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'genre' ? ' _active' : '' }}" href="{{ route('genre.list') }}">Жанры</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'theme' ? ' _active' : '' }}" href="{{ route('theme.list') }}">Темы</a>
            </li>
        </ul>
    </nav>
</aside>
