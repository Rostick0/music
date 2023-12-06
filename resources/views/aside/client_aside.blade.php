<aside class="admin-aside">
    <div class="admin-aside__top">
        <div class="admin-aside__logo">
            <img src="{{ $site->logo }}" alt="" style="width:200px">
        </div>
        <div class="admin-aside__burger-close"> </div>
    </div>
    <nav class="admin-aside__nav">
        <ul class="admin-aside__navigation">
            <li class="admin-aside__navigation_item{{ Request::segment(2) === 'subscriptions' ? ' _active' : '' }}">
                <a class="admin-aside__navigation_link" href="{{ route('client.subscriptions') }}">Subscriptions</a>
            </li>
            <li class="admin-aside__navigation_item{{ Request::segment(2) === 'remove_claim' ? ' _active' : '' }}">
                <a class="admin-aside__navigation_link" href="{{ route('client.remove_claim.list') }}">Remove claim</a>
            </li>
            <li class="admin-aside__navigation_item{{ Request::segment(2) === 'account' ? ' _active' : '' }}">
                <a class="admin-aside__navigation_link" href="{{ route('client.account.list') }}">Accounts</a>
            </li>
            <li class="admin-aside__navigation_item{{ Request::segment(2) === 'story' ? ' _active' : '' }}">
                <a class="admin-aside__navigation_link" href="{{ route('client.story.list') }}">Story</a>
            </li>
            <li class="admin-aside__navigation_item{{ Request::segment(2) === 'music' ? ' _active' : '' }}">
                <a class="admin-aside__navigation_link" href="{{ route('client.music.list') }}">Music</a>
            </li>
            <li class="admin-aside__navigation_item">
                <a class="admin-aside__navigation_link{{ Request::segment(2) === 'license' ? ' _active' : '' }}"
                    href="{{ route('client.license.list') }}">Licenses</a>
            </li>
        </ul>
    </nav>
</aside>
