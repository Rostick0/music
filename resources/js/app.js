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

    if (!links?.length) return;

    links?.forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault();

            const coordY = document.querySelector(item.getAttribute('href')).getBoundingClientRect().top;

            window.scroll({
                top: coordY,
                behavior: 'smooth'
              });
        });
    });
})();