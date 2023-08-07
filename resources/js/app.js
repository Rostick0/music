import { asyncSelect } from './ui';

(function () {
    const musicSelectAsync = document.querySelector('.music-select-async');

    if (!musicSelectAsync) return;

    const asyncGetMusic = (value) => {
        return fetch('/api/music?title=' + value)
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
    new LazyLoad({
        elements_selector: ".lazy"
    });
})();