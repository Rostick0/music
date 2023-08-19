import { myFetch } from './front';
import { addClass, removeClass } from './helpers';
import { asyncSelect } from './ui';

(function () {
    const musicSelectAsync = document.querySelector('.music-select-async');

    if (!musicSelectAsync) return;

    const asyncGetMusic = (value) => {
        return myFetch('/api/music?title=' + value)
            .then(res => {
                if (!res?.ok) throw new Error();

                return res.json();
            })
            .then(res => {
                return res?.data?.data ?? [];
            })
    };

    asyncSelect(musicSelectAsync, asyncGetMusic);
})();

(function () {
    const adminFileUpload = document.querySelectorAll('.admin-file-upload');

    if (!adminFileUpload?.length) return;

    adminFileUpload.forEach(item => {
        const adminFileUploadInput = item.querySelector('.admin-file-upload__input');
        const adminfileUploadName = item.querySelector('.admin-file-upload__name');

        adminFileUploadInput.onchange = function () {
            const file = this.files[0]

            adminfileUploadName.textContent = file?.name;
        }
    })
})();

(function () {
    new LazyLoad({
        elements_selector: ".lazy"
    });
})();

(function () {
    const adminAside = document.querySelector('.admin-aside');
    const adminAsideBurgerClose = document.querySelector('.admin-aside__burger-close');
    const adminContentBurger = document.querySelector('.admin-content__burger');

    if (!(adminAside && adminAsideBurgerClose && adminContentBurger)) return;

    adminAsideBurgerClose.onclick = () => removeClass(adminAside, '_active');
    adminContentBurger.onclick = () => addClass(adminAside, '_active');
})();

(function () {
    const adminDetails = document.querySelectorAll('.admin-details')

    if (!adminDetails) return;

    adminDetails.forEach(detail => {

        detail.setAttribute('tabindex', 1);

        detail.onblur = () => {
            console.log(5);
        }

        detail?.querySelectorAll('.admin-checkbox')?.forEach(label => {
            label.onclick = () => {
                detail.removeAttribute('open');
            }
        })
    })
})();

(function () {
    const links = document.querySelectorAll('a[href*="#"]');

    if (links?.length) return;

    links?.forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault();

            // для каждого якоря берем соответствующий ему элемент и определяем его координату Y
            let coordY = document.querySelector(item.getAttribute('href')).getBoundingClientRect().top + window.pageYOffset;

            // запускаем интервал, в котором
            let scroller = setInterval(function () {
                // считаем на сколько скроллить за 1 такт
                let scrollBy = coordY / framesCount;

                // если к-во пикселей для скролла за 1 такт больше расстояния до элемента и дно страницы не достигнуто
                if (scrollBy > window.pageYOffset - coordY && window.innerHeight + window.pageYOffset < document.body.offsetHeight) {
                    // то скроллим на к-во пикселей, которое соответствует одному такту
                    window.scrollBy(0, scrollBy);
                } else {
                    // иначе добираемся до элемента и выходим из интервала
                    window.scrollTo(0, coordY);
                    clearInterval(scroller);
                }
            }, 20 / 300);
        });
    });
})();