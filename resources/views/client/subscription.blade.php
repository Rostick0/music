@extends('layout.client.index')


@section('html')
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
    </div>
@endsection
