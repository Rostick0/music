@extends('layout.client.index')


@section('html')
    <div class="container">
        <div id="subscription" class="content">
            <h2>Subscription management</h2>
            @if ($subscriptions->count())
                <table id="subscription-table" class="subscription-table">
                    <tr>
                        <th>Name</th>
                        <th>Date created</th>
                        <th>Date end</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($subscriptions as $subscription)
                        <tr>
                            <td>{{ $subscription->subscription_type->name }} @if ($subscription->subscription_type->price != $max_price_subscription)
                                    <a href="https://topaudio.store/pricing" style="font-size: small;">upgrade</a>
                                @endif
                            </td>
                            <td>{{ date('d.m.Y', strtotime($subscription->created_at)) }}</td>
                            <td>{{ date('d.m.Y', strtotime($subscription->date_end)) }}</td>
                            <td><button class="admin-button admin-button-gradient"
                                    @if ($subscription->is_auto_renewal) disabled @endif>Cancel</button>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <br>
                {{ $subscriptions->links('vendor.front-pagination') }}
            @else
                <div id="no-subscription">
                    <p>You don't have any subscription packages. Do you want to start? <a
                            href="https://topaudio.store/pricing">Go to Subscriptions</a></p>
                </div>
            @endif
        </div>
    </div>
@endsection
