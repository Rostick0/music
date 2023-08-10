@include('layout.head')
@vite(['resources/scss/admin/index.scss'])

<div class="admin-wrapper">
    @include('aside.client_aside')
    <div class="admin-content">
        <div class="admin-content__top">
            <a class="admin-content__top_item" href="{{ route('client.profile_edit') }}">личный кабинет</a>
            <a class="admin-content__top_item" href="{{ route('logout') }}">Выход</a>
        </div>
        <div class="admin-content__inner">
            @yield('html')
        </div>
    </div>
</div>

<div class="modal-agree">
    <div class="modal-agree__inner">
        <div class="modal-agree__title">Пользовательское соглашение</div>
        <div class="modal-agree__description">Пользуясь этим сайтом, вы принимаете ...</div>
        <button class="admin-button modal-agree__button">Согласен</button>
    </div>
</div>

@php
    $token_controller = new App\Http\Controllers\TokenController();
@endphp



@include('layout.footer')

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
                'X-CSRF-TOKEN': {{ "`" . csrf_token() . "`" }}
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
                    if (!res?.ok) return;

                    return res?.json();
                })
                .then(() => {
                    if (!modalAgree.classList.contains('_active')) return;

                    modalAgree.classList.remove('_active')
                });
        };
    })();
</script>
