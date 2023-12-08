<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top-Audio Store by Top Flow</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
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

        .header,
        .footer {
            background-color: #fff;
            padding: 10px 20px;
            text-align: center;
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
            background-color: #ffa500;
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
            display: none;
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
    @php
        $token_controller = new App\Http\Controllers\TokenController();
        $max_channels = auth()->user()?->subscription_last?->subscription_type?->сhannel ?? 0;
    @endphp
    <script>
        const userId = {{ auth()->id() ?? 'null' }};
        const hasSubscription = {{ app('has_subscription') ?? 'null' }};
        const accessToken = {{ '`' . $token_controller->get() . '`' ?? 'null' }};
    </script>
</head>

<body>

    <div class="header">
        Top-Audio Store by Top Flow
    </div>

    <div class="navbar">
        <a href="#subscription">Управление Подпиской</a>
        <a href="#licenses" class="active">Скачки</a>
        <a href="#content-management">Управление Контентом</a>
        <a href="#settings">Настройки</a>
        <a href="#support">Контакт и Поддержка</a>
    </div>

    <div class="container">
        <div class="container">

            <div id="subscription" class="content">
                <h2>Управление Подпиской</h2>
                <div id="no-subscription" style="display: none;">
                    <p>У вас нет приобретенных пакетов. Хотите начать? <a href="https://topaudio.store/pricing">Перейти
                            к пакетам</a></p>
                </div>

                <table id="subscription-table" style="display: none;" class="subscription-table">
                    <tr>
                        <th>Название Пакета</th>
                        <th>Дата Приобретения</th>
                        <th>Дата Окончания</th>
                        <th>Действие</th>
                    </tr>
                    @foreach ($subscriptions as $subscription)
                        <tr>
                            <td>{{ $subscription->subscription_type->name }} @if ($subscription->subscription_type->price != $max_price_subscription)
                                    <a href="https://topaudio.store/pricing" style="font-size: small;">upgrade</a>
                                @endif
                            </td>
                            <td>{{ date('d.m.Y', strtotime($subscription->created_at)) }}</td>
                            <td>{{ date('d.m.Y', strtotime($subscription->date_end)) }}</td>
                            <td><button @if ($subscription->is_auto_renewal) disabled @endif>Отменить Подписку</button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div id="licenses" class="content" style="display: block;">
                <h2>Лицензии</h2>
                <table class="licenses-table">
                    <thead>
                        <tr>
                            <th>Автор - Название трека</th>
                            <th>Лицензионный номер</th>
                            <th>Почта Клиента</th>
                            <th>Дата генерации</th>
                            <th>Скачать Лицензию</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Здесь будут строки, заполненные сервером -->
                        @foreach ($licenses as $license)
                            <tr>
                                <td>{{ $license?->licensesable?->title }}</td>
                                <td>{{ $license->code }}</td>
                                <td>{{ $license->user->email }}</td>
                                <td>{{ date('d.m.Y', strtotime($license->created_at)) }}</td>
                                <td><a class="btn-download"
                                        href="{{ route('client.license.show', [
                                            'id' => $license->id,
                                        ]) }}">Скачать</a>
                                </td>
                            </tr>
                        @endforeach
                        <!-- Повторение строк для каждой лицензии -->
                    </tbody>
                </table>
            </div>

            <div id="content-management" class="content">
                <h2>Управление Контентом</h2>

                <div class="form-section">
                    <h3>Анклейм YouTube Видео</h3>
                    <form>
                        <label for="track-select">Выберите трек:</label>
                        <select id="track-select" name="track">
                            <!-- Предполагается, что эти опции заполняются данными с сервера -->
                            @foreach ($music as $music_item)
                                <option value="{{ $music_item->id }}">{{ $music_item->title }}</option>
                            @endforeach
                            <!-- Другие треки -->
                        </select>

                        <label for="youtube-url">Ссылка на YouTube видео:</label>
                        <input type="url" id="youtube-url" name="youtube-url"
                            placeholder="https://www.youtube.com/watch?v=..." required>
                        <button id="button-link" onclick="handleVideoSubmit()" type="submit">Отправить</button>
                    </form>
                </div>

                <div class="form-section">
                    <h3>Управление YouTube Каналами</h3>
                    <p id="channelCounter">Добавление {{ $accounts->count() }} из {{ $max_channels }} возможных.</p>
                    <input type="url" id="new-channel-url" placeholder="URL канала" required>
                    <button onclick="addChannel()">Добавить Канал</button>

                    <table class="channels-table" id="channelsTable">
                        <tr>
                            <th>URL Канала</th>
                            <th>Дата Добавления</th>
                            <th>Действие</th>
                        </tr>
                        <!-- Строки таблицы будут добавляться здесь -->
                        @foreach ($accounts as $account)
                            <tr>
                                <td>{{ $account->url }}</td>
                                <td>{{ date('d.m.Y', strtotime($account->created_at)) }}</td>
                                <td><button data-id="{{ $account->id }}"
                                        onclick="removeChannel(this)">Удалить</button></td>
                            </tr>
                        @endforeach
                    </table>
                    <p>Хотите добавить больше каналов? <a href="https://topaudio.store/pricing">Перейти к пакетам</a>
                    </p>
                </div>
            </div>


            <div id="settings" class="content">
                <h2>Настройки</h2>
                <p>Личная информация, настройки безопасности, уведомлений...</p>
            </div>

            <div id="support" class="content">
                <h2>Контакт и Поддержка</h2>
                <p>Служба поддержки, контактные данные...</p>

            </div>
        </div>

        <div class="footer">
            <p>© 2023 Top-Audio Store by Top Flow</p>
        </div>
    </div>

    @vite(['resources/js/app.js'])
    @vite(['resources/js/front.js'])

    <script>
        const myFetch = (url, options = {}) => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            const bearerToken = typeof accessToken === 'string' && accessToken ? 'Bearer ' + accessToken : null;

            const {
                headers,
                ...other
            } = options;
            return fetch(url, {
                ...other,
                headers: {
                    ...headers,
                    Authorization: bearerToken,
                    'X-CSRF-TOKEN': csrfToken
                }
            })
        }

        var maxChannels = {{ $max_channels }}; // Максимальное количество каналов для этого пользователя
        var currentChannels = {{ $accounts->count() }}; // Текущее количество добавленных каналов

        function isValidURL(url) {
            try {
                new URL(url);
                return true;
            } catch (e) {
                return false;
            }
        }

        async function addChannel() {
            if (currentChannels < maxChannels) {
                const value = document.getElementById("new-channel-url").value;
                if (!value?.length || !isValidURL(value)) return alert('Неверный url');

                var table = document.getElementById("channelsTable");
                var row = table.insertRow(-1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);

                const formData = new FormData();
                formData.append('url', value);

                await myFetch('/api/account', {
                        method: "POST",
                        body: formData
                    })
                    .then(res => res.json())
                    .then(res => {
                        const data = res.data

                        cell1.innerHTML = value;
                        cell2.innerHTML = new Date().toLocaleDateString();
                        cell3.innerHTML =
                            `<button data-id="${data.id}" onclick="removeChannel(this)">Удалить</button>`;

                        currentChannels++;
                        updateChannelCounter();
                    })
            } else {
                alert("Вы достигли максимального количества каналов для вашей подписки.");
            }
        }

        async function removeChannel(btn) {
            const id = btn.getAttribute('data-id');
            var row = btn.parentNode.parentNode;
            console.log(id)

            const data = await myFetch('/api/account/' + id, {
                method: "DELETE",
            });

            row.parentNode.removeChild(row);
            currentChannels--;
            updateChannelCounter();
        }

        function updateChannelCounter() {
            document.getElementById("channelCounter").innerHTML = "Добавление " + currentChannels + " из " + maxChannels +
                " возможных.";
        }


        const buttonLink = document.querySelector('#button-link')
        buttonLink.onclick = async (e) => {
            e.preventDefault();
            alert("Ваше видео успешно отправлено и будет обработано в течении нескольких минут!");
            const trackSelect = document.querySelector('#track-select');
            const youtubeUrl = document.querySelector('#youtube-url');

            console.log(trackSelect)
            console.log(youtubeUrl)

            const formData = new FormData();
            formData.append('music_id', trackSelect.value);
            formData.append('link', youtubeUrl.value);


            await myFetch('/api/remove-claim', {
                method: "POST",
                body: formData
            });
            return false; // Чтобы предотвратить стандартное поведение отправки формы
        }



        document.addEventListener("DOMContentLoaded", function() {
            // Управление отображением информации о подписке
            if (hasSubscription) {
                document.getElementById("subscription-table").style.display = "";
            } else {
                document.getElementById("no-subscription").style.display = "";
            }

            // Управление навигацией
            var navbarLinks = document.querySelectorAll('.navbar a');
            navbarLinks.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    navbarLinks.forEach(function(lnk) {
                        lnk.classList.remove('active');
                    });
                    document.querySelectorAll('.content').forEach(function(cont) {
                        cont.style.display = 'none';
                    });

                    var activeSection = document.querySelector(this.getAttribute('href'));
                    activeSection.style.display = 'block';
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>

</html>
