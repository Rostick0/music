export const objConvertUrl = obj => {
    return '?' + new URLSearchParams(obj).toString();
}

export const addClass = (elem, className) => {
    if (elem?.classList?.contains(className)) return;

    elem?.classList?.add(className);
};

export const addClassOnce = (elem, className) => {
    elem?.classList?.add(className);
};

export const removeClass = (elem, className) => {
    if (!elem?.classList?.contains(className)) return;

    elem.classList.remove(className);
};

export const normalizeTime = (duration) => {
    let time = duration.slice(3);

    return time;
};

export const removeEmpty = (obj) => {
    return Object.fromEntries(Object.entries(obj).filter(([_, v]) => !!v));
};

export const getLocalVolume = () => {
    const volume = localStorage.getItem('volume') ?? 1

    if (volume >= 1) return 1;

    return volume;
};

export const setLocalVolume = volume => {
    localStorage.setItem('volume', volume);
}