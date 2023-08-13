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