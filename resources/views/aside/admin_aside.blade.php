<aside class="admin-aside">
    <div class="admin-aside__top">
        <div class="admin-aside__logo">
            <img src="{{ $site->logo }}" alt="" style="width:150px">
        </div>
        <div class="admin-aside__burger-close"></div>
    </div>
    <nav class="admin-aside__nav">
        <ul class="admin-aside__navigation">
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'music' ? ' _active' : '' }}"
                    href="{{ route('music.list') }}">Tracks</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'music_kit' ? ' _active' : '' }}"
                    href="{{ route('music_kit.list') }}">Music kit tracks</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'playlist' ? ' _active' : '' }}"
                    href="{{ route('playlist') }}">Playlists</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'statistic' ? ' _active' : '' }}"
                    href="{{ route('statistic') }}">Statistic</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'subscriptions' ? ' _active' : '' }}"
                    href="{{ route('subscriptions') }}">Subscriptions</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'subscription_type' ? ' _active' : '' }}"
                    href="{{ route('subscription_type.list') }}">Types of subscriptions</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'users' ? ' _active' : '' }}"
                    href="{{ route('user.list') }}">Clients</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'pages' ? ' _active' : '' }}"
                    href="{{ route('page.list') }}">Pages</a>
            </li>
            {{-- <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'components' ? ' _active' : '' }}" href="{{ route('component.list') }}">Компоненты</a>
            </li> --}}
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'settings' ? ' _active' : '' }}"
                    href="{{ route('settings') }}">Settings</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'menu' ? ' _active' : '' }}"
                    href="{{ route('menu.list') }}">Menu</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'genre' ? ' _active' : '' }}"
                    href="{{ route('genre.list') }}">Genre</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'theme' ? ' _active' : '' }}"
                    href="{{ route('theme.list') }}">Themes</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'mood' ? ' _active' : '' }}"
                    href="{{ route('mood.list') }}">Moods</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'instrument' ? ' _active' : '' }}"
                    href="{{ route('instrument.list') }}">Instruments</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'account' ? ' _active' : '' }}"
                    href="{{ route('account.list') }}">Accounts</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'story' ? ' _active' : '' }}"
                    href="{{ route('story.list') }}">Download history</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'pdf' ? ' _active' : '' }}"
                    href="{{ route('pdf.edit') }}">License settings</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'license' ? ' _active' : '' }}"
                    href="{{ route('license.list') }}">Client's license</a>
            </li>
        </ul>
    </nav>
</aside>
