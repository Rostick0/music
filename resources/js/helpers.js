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
    let time = duration.slice(0, -3);

    if (time[0] == '0') time = time.slice(1);

    return time;
}

export const removeEmpty = (obj) => {
    return Object.fromEntries(Object.entries(obj).filter(([_, v]) => !!v));
}