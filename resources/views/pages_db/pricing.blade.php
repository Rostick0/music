@extends('layout.front.index')

@section('seo_title', $site_page?->seo_title)
@section('seo_description', $site_page?->seo_description)

@section('html')
    <section class="section-page pricing">
        <div class="container">
            <div class="pricing__container">
                <h1 class="section-title-big pricing__title">Pricing plan</h1>
                <ul class="pricing__list">
                    @foreach (App\Models\SubscriptionType::all() as $subscription_type)
                        <li class="pricing__item pricing-item">
                            <div class="pricing-item__block">
                                <div class="pricing-item__title">{{ $subscription_type->name }}</div>
                                <div class="pricing-item__price">{{ $subscription_type->price }} $</div>
                                <div class="pricing-item__info">{!! $subscription_type->description ?? '' !!}</div>
                                <form action="https://unitpay.ru/pay/441707-c74ca" method="post">
                                    <input type="hidden" name="account" value="demo">
                                    <input type="hidden" name="sum" value="{{ $subscription_type->price }}">
                                    <input type="hidden" name="desc" value="{{ $subscription_type->description }}">
                                    <input type="hidden" name="locale" value="en">
                                    <input type="hidden" name="currency" value="USD">
                                    <input type="hidden" name="signature"
                                        value="e54cb651d4e5c5c4a6a8bf5d135879a49b7cfc2db72d1115f621b049a6ec304e">
                                    <button class="button-gradient pricing-item__button">Buy</button>
                                </form>
                            </div>
                            @if ($subscription_type->advantages)
                                <div class="pricing-item__advantages">{!! $subscription_type->advantages !!}</div>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <div class="pricing__buttons">
                    <a class="button-white pricing__button" href="/register">Sign up</a>
                    <a class="button-gradient pricing__button" href="/login">Sign in</a>
                </div>
            </div>
        </div>
    </section>
@endsection
