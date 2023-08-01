@extends('layout.front.index')

@section('php')
    @php
        $subscription_types = App\Models\SubscriptionType::all();
    @endphp
@endsection

@section('html')
    <section class="section-page pricing">
        <div class="container">
            <div class="pricing__container">
                <h1 class="section-title-big pricing__title">Pricing plan</h1>
                <ul class="pricing__list">
                    @foreach ($subscription_types as $subscription_type)
                        <li class="pricing__item pricing-item">
                            <div class="pricing-item__block">
                                <div class="pricing-item__title">{{ $subscription_type->name }}</div>
                                <div class="pricing-item__info">{{ $subscription_type->price }},
                                    {{ $subscription_type->description ?? '' }}</div>
                                <button class="button-gradient pricing-item__button">Buy</button>
                            </div>
                            @if ($subscription_type->advantages)
                                <div class="pricing-item__advantages">{{ $subscription_type->advantages }}</div>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <div class="pricing__buttons">
                    <a class="button-gradient pricing__button" href="/login">Sing in</a>
                    <a class="button-white pricing__button" href="/register">Sing up</a>
                </div>
            </div>
        </div>
    </section>
@endsection
