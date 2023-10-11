<aside class="admin-aside">
    <div class="admin-aside__top">
        <div class="admin-aside__logo">
            <img src="{{ $site->logo }}" alt="">
        </div>
        <div class="admin-aside__burger-close"> </div>
    </div>
    <nav class="admin-aside__nav">
        <ul class="admin-aside__navigation">
            <li class="admin-aside__navigation_item{{ Request::segment(2) === 'subscriptions' ? ' _active' : '' }}">
                <a class="admin-aside__navigation_link" href="{{ route('client.subscriptions') }}">Подписки</a>
            </li>
            <li class="admin-aside__navigation_item{{ Request::segment(2) === 'remove_claim' ? ' _active' : '' }}">
                <a class="admin-aside__navigation_link" href="{{ route('client.remove_claim.list') }}">Удаление
                    копирайта</a>
            </li>
            <li class="admin-aside__navigation_item{{ Request::segment(2) === 'client' ? ' _active' : '' }}">
                <a class="admin-aside__navigation_link" href="{{ route('client.youtube.edit') }}">Ютуб аккаунт</a>
            </li>
        </ul>
    </nav>
</aside>
