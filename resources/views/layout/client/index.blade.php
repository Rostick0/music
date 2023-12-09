@include('layout.head')
@vite(['resources/scss/admin/index.scss'])

@section('seo_title', 'Top-Audio Store by Top Flow')

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">


<div class="header">
    <div>Top-Audio Store by Top Flow</div>
    <a class="header__logout" href="{{ route('logout') }}">Выход</a>
</div>

<div class="navbar">
    <a class="{{ Request::route()->getName() === 'client.subscription' ? ' active' : '' }}"
        href="{{ route('client.subscription') }}">Subscription</a>
    <a class="{{ Request::route()->getName() === 'client.index' ? ' active' : '' }}"
        href="{{ route('client.index') }}">License</a>
    <a class="{{ Request::route()->getName() === 'client.account' ? ' active' : '' }}"
        href="{{ route('client.account') }}">Accounts</a>
    <a class="{{ Request::route()->getName() === 'client.settings' ? ' active' : '' }}"
        href="{{ route('client.settings') }}">Settings</a>
    <a class="{{ Request::route()->getName() === 'client.support' ? ' active' : '' }}"
        href="{{ route('client.support') }}">Support</a>
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
<style>
    h2 {
        margin-bottom: 20px;
    }

    h3 {
        margin-bottom: 10px;
    }

    .form-section {
        margin-bottom: 20px;
        /* Добавляем немного пространства между разделами */
    }

    .channels-table,
    .licenses-table,
    .subscription-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .channels-table th,
    .channels-table td,
    .licenses-table th,
    .licenses-table td,
    .subscription-table th,
    .subscription-table td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    .channels-table th,
    .licenses-table th,
    .subscription-table th {
        background-color: #ffa500;
        color: white;
    }

    .channels-table td:nth-child(2),
    .licenses-table td:nth-child(2),
    .subscription-table td:nth-child(2) {
        text-align: left;
    }

    .channels-table tr:nth-child(even),
    .licenses-table tr:nth-child(even),
    .subscription-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .channels-table tr:hover,
    .licenses-table tr:hover,
    .subscription-table tr:hover {
        background-color: #f5f5f5;
    }

    .btn-download {
        background-color: #4CAF50;
        /* Green */
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background-color: #f7f7f7;
    }

    * {
        font-family: 'Montserrat', sans-serif;
    }

    .header {
        position: relative;
    }

    .header__logout {
        position: absolute;
        top: 0;
        right: 20px;
        transform: translateY(50%);
    }

    .header,
    .footer {
        background-color: #fff;
        padding: 10px 20px;
        text-align: center;
    }

    .footer {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar {
        background-color: #fff;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: center;
    }

    .navbar a {
        color: #333;
        text-align: center;
        padding: 14px 20px;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s;
    }

    .navbar a:hover,
    .navbar a.active {
        background: linear-gradient(225deg, #FF9211 0%, #F11 100%);
        color: white;
    }

    .container {
        flex: 1;
        padding: 20px;
        width: 100%;
        max-width: 1200px;
        margin: auto;
    }

    .content {
        margin-top: 20px;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .footer {
        background-color: #fff;
        color: var(--dark);
        box-shadow: 0 2px 4px rgb(0 0 0 / 10%);
        text-align: center;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        right: 0;
    }
</style>

@include('layout.footer')
