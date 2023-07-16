import './libs/swiper';
import './libs/wavesurfer';

try {
    new Swiper(".mySwiper", {
        slidesPerView: 5,
        spaceBetween: 36,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
    });
} catch (e) {

}


(function () {
    const faqItems = document.querySelectorAll('.faq__item');

    if (!faqItems?.length) return;

    faqItems?.forEach(item => {
        const itemSwitch = item?.querySelector('.faq__switch');

        if (!itemSwitch) return;

        itemSwitch.onclick = () => item.classList.toggle('_active');
    })
})();

(function () {
    const selects = document.querySelectorAll('.select');

    if (!selects?.length) return;

    selects?.forEach(select => {
        const selectSwitch = select.querySelector('.select__switch');
        const selectValue = select.querySelector('.select__value');
        const selectInput = select.querySelector('.select__input');

        selectSwitch.onclick = () => {
            select.classList.toggle('_active')
        };

        select.onblur = () => {
            if (!select.classList.contains('_active')) return;

            select.classList.remove('_active');
        };

        const selectItems = select.querySelectorAll('.select__item');
        selectItems?.forEach(item => {
            item.onclick = () => {
                selectValue.textContent = item?.textContent;
                selectInput.value = item?.getAttribute('data-id');

                if (!select.classList.contains('_active')) return;

                select.classList.remove('_active');
            };
        })
    })
})();

(function () {
    const trackItems = document.querySelectorAll('.track-item');

    if (!trackItems?.length) return;

    trackItems?.forEach(item => {
        let isActive = false;

        const wavesurfer = WaveSurfer.create({
            container: '.' + item.querySelector('.track-item__audio').classList?.value?.replace(' ', '.'),
            waveColor: 'rgba(27, 18, 30, .2)',
            progressColor: '#FF1111',
            url: '/audio/1686521221.mp3',
            height: 40,
        });

        const trackItemButton = item.querySelector('.track-item__button');

        trackItemButton.onclick = () => {
            if (!isActive) {
                wavesurfer?.play();
            } else {
                wavesurfer?.pause();
            }

            isActive = !isActive;
        };
    })
})();

(function () {
    const tracksFilter = document.querySelector('.tracks__filter');


    if (!tracksFilter) return;

    tracksFilter.onchange = e => {
        console.log(e);
    }

    
})();