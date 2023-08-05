@php
    $faq_list = App\Models\SiteFaq::all();
@endphp

@if (!empty($faq_list))
    <section class="section section-main faq">
        <div class="container">
            <h2 class="section-title faq__title">FAQ</h2>
            <ul class="faq__list">
                @foreach ($faq_list as $faq_item)
                    <li class="faq__item">
                        <div class="faq__switch">
                            <div class="faq__question text-big">{{ $faq_item->question }}</div>
                            <div class="faq__icon"></div>
                        </div>
                        <div class="faq__answer text-medium">{{ $faq_item->answer }}</div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endif
