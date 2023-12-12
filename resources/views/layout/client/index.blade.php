@include('layout.head')
@vite(['resources/scss/admin/index.scss'])

@section('seo_title', 'Top-Audio Store by Top Flow')

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">


<div class="header">
    <div class="container">
        <div class="header__container">
            <a class="header__logo" href="/">
                <img src="{{ $site->logo }}" width="150" alt="Top Audio">
            </a>
            <div>Top-Audio Store by Top Flow</div>
        </div>
    </div>
</div>

<div class="navbar">
    <a class="{{ Request::route()->getName() === 'client.subscription' ? ' active' : '' }}"
        href="{{ route('client.subscription') }}">Subscription</a>
    <a class="{{ Request::route()->getName() === 'client.index' ? ' active' : '' }}"
        href="{{ route('client.index') }}">Download</a>
    <a class="{{ Request::route()->getName() === 'client.account' ? ' active' : '' }}"
        href="{{ route('client.account') }}">Accounts</a>
    <a class="{{ Request::route()->getName() === 'client.settings' ? ' active' : '' }}"
        href="{{ route('client.settings') }}">Settings</a>
    <a class="{{ Request::route()->getName() === 'client.support' ? ' active' : '' }}"
        href="{{ route('client.support') }}">Support</a>
    <a href="{{ route('logout') }}">Logout</a>
</div>

<div class="modal-agree">
    <div class="modal-agree__inner">
        <div class="modal-agree__title">User agreement</div>
        <div class="modal-agree__description">{!! app('site')->user_policy !!}</div>
        <button class="admin-button modal-agree__button">Agree</button>
    </div>
</div>

@php
    $token_controller = new App\Http\Controllers\TokenController();
@endphp

<script defer>
    const userId = {{ auth()->id() ?? 'null' }};
    const hasSubscription = {{ $has_subscription ?? 'null' }};
    const accessToken = {{ '`' . $token_controller->get() . '`' ?? 'null' }};

    const userAgree = {{ auth()->user()->is_agree ?? 'null' }};
    const myFetch = (url, options = {}) => {
        const bearerToken = typeof accessToken === 'string' && accessToken ? 'Bearer ' + accessToken : null;

        const {
            headers,
            ...other
        } = options;

        return fetch(url, {
            ...other,
            headers: {
                Authorization: bearerToken,
                'X-CSRF-TOKEN': {{ '`' . csrf_token() . '`' }}
            }
        })
    }

    (function() {
        if (typeof userAgree !== 'number' || userAgree !== 0) return;

        const modalAgree = document.querySelector('.modal-agree');
        modalAgree?.classList?.add('_active')
        const modalAgreeButton = document.querySelector('.modal-agree__button');

        if (!modalAgreeButton) return;

        modalAgreeButton.onclick = () => {
            myFetch('/api/agree', {
                    method: 'post'
                })
                .then(res => {
                    if (res?.status < 200 && res?.status >= 400) throw null;

                    return res?.json();
                })
                .then(() => {
                    if (!modalAgree.classList.contains('_active')) return;

                    modalAgree.classList.remove('_active')
                });
        };
    })();
</script>

<div class="container">
    @yield('html')
    <div class="footer">
        <p>© 2023 Top-Audio Store by Top Flow</p>
    </div>
</div>

@vite(['resources/scss/client.scss'])

@include('layout.footer')
