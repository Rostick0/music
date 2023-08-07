import { throttle } from './optimization';

export const asyncSelect = (selectDom, asyncFunction) => {
    const select = selectDom;

    const selectInput = select.querySelector('.admin-select-async__input');
    const selectValue = select.querySelector('.admin-select-async__value');
    const selectList = select.querySelector('.admin-select-async__list');

    // select.onblur = (e) => {
    //     if (!select.classList.contains('_active')) return;

    //     select.classList.remove('_active')
    // }

    const setActiveFalse = () => {
        if (!select.classList.contains('_active')) return;

        select.classList.remove('_active');
    }

    selectInput.onclick = () => {
        select.classList.toggle('_active');
    }

    selectInput.oninput = throttle(async e => {
        if (typeof asyncFunction !== 'function') return;

        const result = await asyncFunction(e.target.value);

        document.querySelectorAll('.admin-select-async__item')?.forEach(item => item.remove());

        if (!result?.length) {
            selectList.insertAdjacentHTML('beforeend', `<li class="admin-select-async__item">Ничего не найдено</li>`);
            return;
        }

        result?.forEach(item => {
            console.log(item);
            selectList.insertAdjacentHTML('beforeend', `<li data-id="${item?.id}" class="admin-select-async__item">${item?.title}, ${item?.music_artist_name}</li>`)
        });

        onclickInitSelectItems();
    }, 500);

    function onclickInitSelectItems() {
        const selectItems = document.querySelectorAll('.admin-select-async__item');
        if (!selectItems?.length) return;

        selectItems?.forEach(item => {
            item.onclick = function () {
                setActiveFalse();
                selectInput.value = item.textContent;
                selectValue.value = item.getAttribute('data-id');
            };
        })
    }

    onclickInitSelectItems();
};