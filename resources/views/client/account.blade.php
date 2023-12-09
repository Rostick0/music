@extends('layout.client.index')

@php
    $max_channels = auth()->user()?->subscription_last?->subscription_type?->сhannel ?? 0;
@endphp

@section('html')
    <div class="container">
        <div id="content-management" class="content">
            <h2>Content</h2>

            <div class="form-section">
                <h3>Remove claim YouTube</h3>
                <form>
                    <label for="track-select">Select track:</label>
                    <select id="track-select" name="track">
                        <!-- Предполагается, что эти опции заполняются данными с сервера -->
                        @foreach ($music as $music_item)
                            <option value="{{ $music_item->id }}">{{ $music_item->title }}</option>
                        @endforeach
                        <!-- Другие треки -->
                    </select>

                    <label for="youtube-url">Link YouTube:</label>
                    <input type="url" id="youtube-url" name="youtube-url"
                        placeholder="https://www.youtube.com/watch?v=..." required>
                    <button id="button-link" type="submit">Send</button>
                </form>
            </div>

            <div class="form-section">
                <h3>YouTube channels</h3>
                <p id="channelCounter">Adding {{ $accounts->count() }} out of {{ $max_channels }} possible.</p>
                <input type="url" id="new-channel-url" placeholder="URL channel" required>
                <button onclick="addChannel()">Add channel</button>

                <table class="channels-table" id="channelsTable">
                    <tr>
                        <th>URL</th>
                        <th>Date created</th>
                        <th>Action</th>
                    </tr>
                    <!-- Строки таблицы будут добавляться здесь -->
                    @foreach ($accounts as $account)
                        <tr>
                            <td>{{ $account->url }}</td>
                            <td>{{ date('d.m.Y', strtotime($account->created_at)) }}</td>
                            <td><button data-id="{{ $account->id }}" onclick="removeChannel(this)">delete</button></td>
                        </tr>
                    @endforeach
                </table>
                <p>Do you want to add more channels? <a href="https://topaudio.store/pricing">Go to Subscriptions</a>
                </p>
            </div>
        </div>
    </div>

    <script defer>
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
                if (!value?.length || !isValidURL(value)) return alert('Invalid url');

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
                            `<button data-id="${data.id}" onclick="removeChannel(this)">Delete</button>`;

                        currentChannels++;
                        updateChannelCounter();
                    })
            } else {
                alert("You have reached the maximum number of channels for your subscription.");
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
            document.getElementById("channelCounter").innerHTML = "Adding  " + currentChannels + " out of " + maxChannels +
                " possible.";
        }


        const buttonLink = document.querySelector('#button-link')
        buttonLink.onclick = async (e) => {
            e.preventDefault();
            const trackSelect = document.querySelector('#track-select');
            const youtubeUrl = document.querySelector('#youtube-url');

            if (!value?.length || !isValidURL(value)) return alert('Invalid url');

            const formData = new FormData();
            formData.append('music_id', trackSelect.value);
            formData.append('link', youtubeUrl.value);


            await myFetch('/api/remove-claim', {
                method: "POST",
                body: formData
            });

            alert("Your video has been sent successfully and will be processed within a few minutes!");
        }
    </script>
@endsection
