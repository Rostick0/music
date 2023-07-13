import { asyncSelect } from './ui';

const func = (value) => {
    return fetch('/api/music?title=' + value)
        .then(res => {
            if (!res?.ok) throw new Error();

            return res.json();
        })
        .then(res => {
            return res?.music ?? [];
        })

};

asyncSelect(document.querySelector('.music-select-async'), func);