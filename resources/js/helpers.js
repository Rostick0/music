export const objConvertUrl = obj => {
    return '?' + new URLSearchParams(obj).toString();
}

export const addClass = (elem, className) => {
    elem?.classList?.add(className);
}

export const removeClass = (elem, className) => {
    if (!elem?.classList?.contains(className)) return;

    elem.classList.remove(className);
}