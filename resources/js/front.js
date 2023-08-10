import { throttle } from './optimization';
import { addClass, addClassOnce, getLocalVolume, normalizeTime, objConvertUrl, removeClass, removeEmpty, setLocalVolume } from './helpers';
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
const STORAGE_URL = '/storage/upload';
const IMAGE_URL = STORAGE_URL + '/image/';
const MUSIC_URL = '/music/';
const MUSIC_DEMO_URL = '/music_demo/';
const MUSIC_KIT_URL = '/music_kit/';

export const myFetch = (url, options = {}) => {
    const bearerToken = typeof accessToken === 'string' && accessToken ? 'Bearer ' + accessToken : null;

    const { headers, ...other } = options;

    return fetch(url, {
        ...other,
        headers: {
            Authorization: bearerToken,
            'X-CSRF-TOKEN': csrfToken
        }
    })
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

function setSelects() {
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
}

setSelects();

(function () {
    let wavesurferPlayer = null;
    const player = document.querySelector('.player');
    const playerVolume = player?.querySelector('.player-volume__input');
    const playerCopy = player?.querySelector('.player__copy');
    const plays = [];
    const musicItems = [];
    const musicList = [];
    let activeMusic = null;

    if (player && playerVolume) {
        playerVolume.value = getLocalVolume() * 100;

        playerVolume.oninput = throttle(e => {
            setLocalVolume(e.target.value / 100)
        }, 20);
    }

    if (player && playerCopy) {
        playerCopy.onclick = () => {
            const urlMusic = location.protocol + '//' + location.host + location.pathname + '/track/' + activeMusic.substr(7)

            navigator.clipboard.writeText(urlMusic);
        }
    }

    document.querySelectorAll('.track-item__audio')?.forEach(item => {
        const dataMusic = item.getAttribute('data-music');

        if (dataMusic) musicList.push(dataMusic);
    });

    const clearActiveMusic = () => {
        const trackItemActive = document.querySelectorAll('.track-item._active');
        if (!trackItemActive?.length) return;

        trackItemActive?.forEach(item => {
            plays?.forEach(item => {
                item?.pause();
                item?.unAll();
            });
            plays?.splice(0, plays?.length - 1);

            removeClass(item, '_active');
        });
    };

    const musicButton = (musicId, favoriteId) => {
        if (favoriteId) {
            return `
            <form action="/favorite/delete/${musicId}" method="post">
                <input type="hidden" name="_token" value="${csrfToken}">
                <button class="track-item__favorite _active">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_98_283)">
                            <path d="M20.6076 11L23.3959 16.5242L28.7626 17.0558C28.8903 17.0664 29.0124 17.1134 29.1143 17.1913C29.2161 17.2691 29.2936 17.3745 29.3374 17.495C29.3813 17.6154 29.3897 17.7459 29.3616 17.871C29.3336 17.9961 29.2703 18.1106 29.1792 18.2008L24.7626 22.5783L26.4001 28.5267C26.4336 28.6528 26.4299 28.786 26.3895 28.9101C26.3492 29.0343 26.2738 29.1441 26.1724 29.2264C26.0711 29.3087 25.9482 29.36 25.8184 29.3741C25.6886 29.3882 25.5575 29.3645 25.4409 29.3058L20.0001 26.6117L14.5667 29.3025C14.4501 29.3611 14.319 29.3848 14.1893 29.3708C14.0595 29.3567 13.9365 29.3054 13.8352 29.2231C13.7339 29.1408 13.6585 29.0309 13.6181 28.9068C13.5777 28.7827 13.5741 28.6495 13.6076 28.5233L15.2451 22.575L10.8251 18.1975C10.734 18.1072 10.6707 17.9928 10.6427 17.8677C10.6147 17.7426 10.6231 17.6121 10.6669 17.4916C10.7107 17.3712 10.7882 17.2658 10.8901 17.1879C10.9919 17.1101 11.114 17.0631 11.2417 17.0525L16.6084 16.5208L19.3926 11C19.4498 10.8882 19.5369 10.7943 19.644 10.7288C19.7512 10.6632 19.8744 10.6285 20.0001 10.6285C20.1257 10.6285 20.2489 10.6632 20.3561 10.7288C20.4633 10.7943 20.5503 10.8882 20.6076 11Z" stroke="#1B121E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                        <defs>
                            <clipPath id="clip0_98_283">
                                <rect width="20" height="20" fill="white" transform="translate(10 10)"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                </button>
            </form>`;
        }

        return `<form action="http://localhost/favorite/create/${musicId}" method="post">
        <input type="hidden" name="_token" value="${csrfToken}">
        <button class="track-item__favorite">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_98_283)">
                    <path d="M20.6076 11L23.3959 16.5242L28.7626 17.0558C28.8903 17.0664 29.0124 17.1134 29.1143 17.1913C29.2161 17.2691 29.2936 17.3745 29.3374 17.495C29.3813 17.6154 29.3897 17.7459 29.3616 17.871C29.3336 17.9961 29.2703 18.1106 29.1792 18.2008L24.7626 22.5783L26.4001 28.5267C26.4336 28.6528 26.4299 28.786 26.3895 28.9101C26.3492 29.0343 26.2738 29.1441 26.1724 29.2264C26.0711 29.3087 25.9482 29.36 25.8184 29.3741C25.6886 29.3882 25.5575 29.3645 25.4409 29.3058L20.0001 26.6117L14.5667 29.3025C14.4501 29.3611 14.319 29.3848 14.1893 29.3708C14.0595 29.3567 13.9365 29.3054 13.8352 29.2231C13.7339 29.1408 13.6585 29.0309 13.6181 28.9068C13.5777 28.7827 13.5741 28.6495 13.6076 28.5233L15.2451 22.575L10.8251 18.1975C10.734 18.1072 10.6707 17.9928 10.6427 17.8677C10.6147 17.7426 10.6231 17.6121 10.6669 17.4916C10.7107 17.3712 10.7882 17.2658 10.8901 17.1879C10.9919 17.1101 11.114 17.0631 11.2417 17.0525L16.6084 16.5208L19.3926 11C19.4498 10.8882 19.5369 10.7943 19.644 10.7288C19.7512 10.6632 19.8744 10.6285 20.0001 10.6285C20.1257 10.6285 20.2489 10.6632 20.3561 10.7288C20.4633 10.7943 20.5503 10.8882 20.6076 11Z" stroke="#1B121E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
                <defs>
                    <clipPath id="clip0_98_283">
                        <rect width="20" height="20" fill="white" transform="translate(10 10)"></rect>
                    </clipPath>
                </defs>
            </svg>
        </button>
    </form>`;
    };
    const audioPlayerEdit = ({ title, artist, time, musicUrl, favoriteId, musicId }, itemDom, wavesurfer) => {
        if (!player) return;

        const playerText = document.querySelector('.player__text');
        const playerAudio = player?.querySelector('.player__audio');
        const playerButton = player?.querySelector('.player__button');
        const playerFavorite = player?.querySelector('.player__favorite');

        playerAudio.innerHTML = null;

        const wavesurferPlayerInner = WaveSurfer.create({
            container: '.' + playerAudio.classList?.value?.replace(' ', '.'),
            waveColor: 'rgba(27, 18, 30, .2)',
            progressColor: '#FF1111',
            url: STORAGE_URL + musicUrl,
            height: 40,
            volume: 0
        });


        wavesurferPlayer = wavesurferPlayerInner;

        wavesurferPlayerInner.on('ready', () => {
            let isWavesurfer2Clicked = false;

            wavesurferPlayerInner.on('click', position => {
                wavesurfer?.seekTo(position);
                isWavesurfer2Clicked = true;
            });

            wavesurfer.on('timeupdate', position => {
                if (isWavesurfer2Clicked) {
                    isWavesurfer2Clicked = false;
                    return;
                }

                wavesurferPlayerInner?.seekTo(position / wavesurfer.duration);
            });
        });

        playerButton.onclick = () => {
            wavesurfer?.playPause();
            player.classList.toggle('_active');

            if (itemDom.classList.contains('_active')) {
                removeClass(itemDom, '_active');
            } else {
                addClass(itemDom, '_active');
            }
        };

        playerFavorite.innerHTML = musicButton(musicId, favoriteId);

        playerText.innerHTML = `
            <div class="track-item__name" title="${title}">${title}</div>
            <div class="track-item__artist" title="${artist}">${artist}</div>`;

        const playerTtime = document.querySelector('.player__time');

        playerTtime.textContent = time;
    };

    const trackItem = item => {
        const trackItemAudio = item.querySelector('.track-item__audio');
        const dataMusic = trackItemAudio.getAttribute('data-music');

        const wavesurfer = WaveSurfer.create({
            container: '.' + trackItemAudio.classList?.value?.replace(' ', '.'),
            waveColor: 'rgba(27, 18, 30, .2)',
            progressColor: '#FF1111',
            url: STORAGE_URL + dataMusic,
            height: 40,
        });

        musicItems.push(dataMusic);

        const trackItemButton = item.querySelector('.track-item__button');
        const func = () => {
            if (!item.classList.contains('_active')) {
                plays.push(wavesurfer);
                clearActiveMusic();
                addClassOnce(player, '_show');
                addClassOnce(player, '_active');
                addClass(item, '_active');
                wavesurfer?.play();
                wavesurfer?.setVolume(getLocalVolume())

                wavesurferPlayer?.unAll();
                activeMusic = dataMusic;
                audioPlayerEdit({
                    title: trackItemAudio.getAttribute('data-title'),
                    artist: trackItemAudio.getAttribute('data-artist'),
                    time: trackItemAudio.getAttribute('data-time'),
                    favoriteId: trackItemAudio.getAttribute('data-favorite'),
                    musicId: trackItemAudio.getAttribute('data-id'),
                    musicUrl: dataMusic
                }, item, wavesurfer);
                return;
            }

            wavesurfer?.pause();
            removeClass(player, '_active');
            removeClass(item, '_active');
            removeClass(player, '_show');
        };

        musicList.push({
            music: dataMusic,
            active: func
        });

        trackItemButton.onclick = func;
    }

    const checkActivePlayer = musicActive => typeof musicActive === 'function' && musicActive();;

    const playerPrev = document.querySelector('.player__prev');
    if (playerPrev) {
        playerPrev.onclick = () => {
            const index = musicList?.findIndex(item => item?.music == activeMusic);
            if (index === 0) {
                checkActivePlayer(musicList?.[musicList?.length - 1]?.active);
                return;
            }

            checkActivePlayer(musicList?.[index - 1]?.active);
        }
    }

    const playerNext = document.querySelector('.player__next');
    if (playerNext) {
        playerNext.onclick = () => {
            const index = musicList?.findIndex(item => item?.music == activeMusic);

            if (index === musicList?.length - 1) {
                checkActivePlayer(musicList?.[0]?.active);
                return;
            }

            checkActivePlayer(musicList?.[index + 1]?.active);
        }
    }

    const initWaveSurfer = () => {
        const trackItems = document.querySelectorAll('.track-item');

        if (!trackItems?.length) return;

        musicList.length = 0;
        trackItems?.forEach(item => trackItem(item));
    }

    initWaveSurfer();

    const downloadButton = (link, linkDemo, isFree) => {
        if (
            isFree || hasSubscription
        ) {
            return STORAGE_URL + MUSIC_URL + link;
        }

        return MUSIC_DEMO_URL + linkDemo;
    };
    const musicItem = (music) => {
        return `<li class="tracks__item track-item">
        <a class="track-item__info" href="/track/${music?.id}">
            <img decoding="async" class="track-item__img"
                src="${music?.image ? IMAGE_URL + music?.image : '/img/music.png'}"
                alt="${music?.title}">
            <div class="track-item__text text-ellipsis">
                ${music?.is_free ? '<div class="track-item__free">FREE</div>' : ''}
                <div class="track-item__name">${music?.title}</div>
                <div class="track-item__artist">${music?.music_artist_name}</div>
            </div>
        </a>
        <div class="track-item__timer">
            <button class="track-button track-item__button">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="40" rx="20"
                        fill="url(#paint0_linear_111_2751)" />
                    <path
                        d="M15 25.509C15.0004 25.9876 15.1322 26.4559 15.3798 26.8581C15.6273 27.2602 15.9801 27.5793 16.3961 27.7771C16.812 27.9749 17.2735 28.0431 17.7254 27.9735C18.1774 27.904 18.6006 27.6996 18.9447 27.3849L27 20.0032L18.9447 12.6169C18.6008 12.3015 18.1775 12.0966 17.7254 12.0267C17.2732 11.9568 16.8114 12.0249 16.3952 12.2228C15.979 12.4207 15.6261 12.7401 15.3787 13.1426C15.1312 13.5452 14.9998 14.014 15 14.4928V25.509Z"
                        fill="white" />
                    <defs>
                        <linearGradient id="paint0_linear_111_2751" x1="40" y1="0"
                            x2="-3.72369" y2="4.59913" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#FF9211" />
                            <stop offset="1" stop-color="#FF1111" />
                        </linearGradient>
                    </defs>
                </svg>
            </button>
            <div class="track-time track-item__time">${normalizeTime(music?.duration)}</div>
        </div>
        <div class="track-item__audio track-item__audio_${music?.id}" data-music="${MUSIC_URL + music?.link}"></div>
        <div class="track-item__buttons">
            ${musicButton()}
            <a class="track-item__download" href="${downloadButton(music?.link, music?.link_demo, music?.is_free)}" download>
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_98_282)">
                        <path d="M20.0007 13.125V23.125" stroke="#1B121E" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M16.2507 19.375L20.0007 23.125L23.7507 19.375" stroke="#1B121E"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M29.3757 23.125V24.375C29.3757 25.038 29.1123 25.6739 28.6435 26.1428C28.1747 26.6116 27.5388 26.875 26.8757 26.875H13.1257C12.4627 26.875 11.8268 26.6116 11.358 26.1428C10.8891 25.6739 10.6257 25.038 10.6257 24.375V23.125"
                            stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </g>
                    <defs>
                        <clipPath id="clip0_98_282">
                            <rect width="20" height="20" fill="white"
                                transform="translate(10 10)" />
                        </clipPath>
                    </defs>
                </svg>
            </a>
            <a class="track-item__buy" href="/pricing">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_98_281)">
                        <path
                            d="M15 25.9374H23.2675C23.5627 25.9375 23.8485 25.833 24.0742 25.6424C24.2997 25.4519 24.4506 25.1877 24.5 24.8966L26.6975 11.9799C26.7471 11.689 26.898 11.4249 27.1236 11.2346C27.3492 11.0443 27.6348 10.9399 27.93 10.9399H28.75"
                            stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M16.5625 28.4375C16.3899 28.4375 16.25 28.2976 16.25 28.125C16.25 27.9524 16.3899 27.8125 16.5625 27.8125"
                            stroke="#1B121E" stroke-width="1.5" />
                        <path
                            d="M16.5625 28.4375C16.7351 28.4375 16.875 28.2976 16.875 28.125C16.875 27.9524 16.7351 27.8125 16.5625 27.8125"
                            stroke="#1B121E" stroke-width="1.5" />
                        <path
                            d="M22.8125 28.4375C22.6399 28.4375 22.5 28.2976 22.5 28.125C22.5 27.9524 22.6399 27.8125 22.8125 27.8125"
                            stroke="#1B121E" stroke-width="1.5" />
                        <path
                            d="M22.8125 28.4375C22.9851 28.4375 23.125 28.2976 23.125 28.125C23.125 27.9524 22.9851 27.8125 22.8125 27.8125"
                            stroke="#1B121E" stroke-width="1.5" />
                        <path
                            d="M24.9607 22.1875H14.9015C14.3441 22.1875 13.8027 22.0011 13.3633 21.658C12.9239 21.315 12.6118 20.835 12.4765 20.2942L11.2682 15.4609C11.2451 15.3687 11.2434 15.2725 11.2631 15.1795C11.2828 15.0866 11.3235 14.9994 11.382 14.9245C11.4405 14.8496 11.5152 14.789 11.6007 14.7474C11.6861 14.7058 11.7798 14.6842 11.8749 14.6842H26.2365"
                            stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </g>
                    <defs>
                        <clipPath id="clip0_98_281">
                            <rect width="20" height="20" fill="white"
                                transform="translate(10 10)" />
                        </clipPath>
                    </defs>
                </svg>
            </a>
        </div>
    </li>`;
    };
    const musicKitItem = (musicKit) => {
        return `<li class="tracks__item track-item">
        <a class="track-item__info" href="/music_kit/${musicKit?.id}">
            <img class="track-item__img"
                src="${musicKit?.music_image ? IMAGE_URL + musicKit?.music_image : '/img/music.png'}"
                alt="{{ $music_item->title }}">
            <div class="track-item__text text-ellipsis">
                <div class="track-item__name">${musicKit?.title}</div>
                <div class="track-item__artist">${musicKit?.music_artist_name}</div>
            </div>
        </a>
        <div class="track-item__timer">
            <button class="track-button track-item__button">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="40" rx="20" fill="url(#paint0_linear_111_2751)" />
                    <g class="track-item__button_start">
                        <path
                            d="M15 25.509C15.0004 25.9876 15.1322 26.4559 15.3798 26.8581C15.6273 27.2602 15.9801 27.5793 16.3961 27.7771C16.812 27.9749 17.2735 28.0431 17.7254 27.9735C18.1774 27.904 18.6006 27.6996 18.9447 27.3849L27 20.0032L18.9447 12.6169C18.6008 12.3015 18.1775 12.0966 17.7254 12.0267C17.2732 11.9568 16.8114 12.0249 16.3952 12.2228C15.979 12.4207 15.6261 12.7401 15.3787 13.1426C15.1312 13.5452 14.9998 14.014 15 14.4928V25.509Z"
                            fill="white" />
                    </g>
                    <g class="track-item__button_pause">
                        <path d="M15.9998 13.6665V27.0002" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M24 13.6665V27.0002" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </g>
                    <defs>
                        <linearGradient id="paint0_linear_111_2751" x1="40" y1="0" x2="-3.72369"
                            y2="4.59913" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#FF9211" />
                            <stop offset="1" stop-color="#FF1111" />
                        </linearGradient>
                    </defs>
                </svg>
            </button>
            <div class="track-time track-item__time">${normalizeTime(musicKit?.duration)}</div>
        </div>
        <div class="track-item__audio track-item__audio_${musicKit?.id}"
            data-music="${MUSIC_KIT_URL + musicKit?.link}" data-title="${musicKit?.name}"
            data-artist="${musicKit?.music_artist_name}"
            data-time="${normalizeTime(musicKit?.duration)}">
        </div>
        <div class="track-item__buttons">
            <a class="track-item__download"
                href="${MUSIC_KIT_URL + musicKit?.link}"
                download>
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_98_282)">
                        <path d="M20.0007 13.125V23.125" stroke="#1B121E" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M16.2507 19.375L20.0007 23.125L23.7507 19.375" stroke="#1B121E"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M29.3757 23.125V24.375C29.3757 25.038 29.1123 25.6739 28.6435 26.1428C28.1747 26.6116 27.5388 26.875 26.8757 26.875H13.1257C12.4627 26.875 11.8268 26.6116 11.358 26.1428C10.8891 25.6739 10.6257 25.038 10.6257 24.375V23.125"
                            stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </g>
                    <defs>
                        <clipPath id="clip0_98_282">
                            <rect width="20" height="20" fill="white" transform="translate(10 10)" />
                        </clipPath>
                    </defs>
                </svg>
            </a>
        </div>
    </li>`;
    };

    (function () {
        const tracksFilter = document.querySelector('.tracks__filter');
        const allInputs = tracksFilter?.querySelectorAll('.select__input');
        const trackList = document.querySelector('.tracks__list');

        if (!(tracksFilter && allInputs)) return;

        const values = {};

        let durationQuery = '';
        const pagination = document.querySelector('.pagination');

        allInputs?.forEach(elem => {
            if (elem.getAttribute('name') !== 'duration') values[elem?.name] = '';

            Object.defineProperty(elem, 'value', {
                set: throttle(function (newValue) {
                    if (elem.getAttribute('name') === 'duration') {
                        durationQuery = newValue;
                    } else {
                        values[this?.name] = newValue;
                    }

                    const covertUrl = objConvertUrl(removeEmpty(values)) + durationQuery;

                    window.history.replaceState(null, null, covertUrl);

                    myFetch('/api/music' + covertUrl)
                        .then(res => {
                            if (!res?.ok) return;

                            return res.json()
                        })
                        .then(res => {
                            trackList.innerHTML = "";

                            const data = res?.data?.data;

                            if (!data.length) {
                                trackList.innerHTML = '<h3 class="tracks__none">Music not found</h3>';
                                return;
                            }

                            if (pagination) pagination.innerHTML = res?.links_html;

                            data.forEach(music => {
                                trackList.insertAdjacentHTML('beforeend', musicItem(music));
                            });

                            initWaveSurfer();
                        });
                }, 500)
            });
        });
    })();

    (function () {
        const musicKitFilter = document.querySelector('.music-kit__filter');
        const allInputs = musicKitFilter?.querySelectorAll('.select__input');
        const musicKitList = document.querySelector('.music-kit__list');

        if (!(musicKitFilter && allInputs)) return;
        const values = {};

        let durationQuery = '';
        const pagination = document.querySelector('.pagination');

        allInputs?.forEach(elem => {
            if (elem.getAttribute('name') !== 'duration') values[elem?.name] = '';

            Object.defineProperty(elem, 'value', {
                set: throttle(function (newValue) {
                    if (elem.getAttribute('name') === 'duration') {
                        durationQuery = newValue;
                    } else {
                        values[this?.name] = newValue;
                    }

                    const covertUrl = objConvertUrl(removeEmpty(values)) + durationQuery;

                    window.history.replaceState(null, null, covertUrl);

                    myFetch('/api/music_kit' + covertUrl)
                        .then(res => {
                            if (!res?.ok) return;

                            return res.json()
                        })
                        .then(res => {
                            musicKitList.innerHTML = "";

                            const data = res?.data?.data;

                            if (!data.length) {
                                musicKitList.innerHTML = '<h3 class="tracks__none">Music kit not found</h3>';
                                return;
                            }

                            if (pagination) pagination.innerHTML = res?.links_html;

                            data.forEach(music => {
                                musicKitList.insertAdjacentHTML('beforeend', musicKitItem(music));
                            });

                            initWaveSurfer();
                        });
                }, 500)
            });
        });
    })();
})();

(function () {
    const playlistFilter = document.querySelector('.playlist__filter');
    if (!playlistFilter) return;

    const allInputs = playlistFilter?.querySelectorAll('.select__input');
    const playlistList = document.querySelector('.playlist__list');

    const playlistItem = (playlist) => {
        return `<a class="playlist__link playlist-item" href="/playlist/${playlist?.id}">
        <img class="playlist-item__img" decoding="async" loading="lazy" src="${playlist?.image ? IMAGE_URL + playlist?.image : '/img/playlist.png'}" alt="">
        <div class="playlist-item__icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_52_568)">
                    <path d="M18.125 1.25H1.875C1.18464 1.25 0.625 1.80964 0.625 2.5V17.5C0.625 18.1904 1.18464 18.75 1.875 18.75H18.125C18.8154 18.75 19.375 18.1904 19.375 17.5V2.5C19.375 1.80964 18.8154 1.25 18.125 1.25Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M3.95825 1.25V18.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M8.22511 14.3833C9.09036 14.3833 9.79178 13.6819 9.79178 12.8167C9.79178 11.9514 9.09036 11.25 8.22511 11.25C7.35987 11.25 6.65845 11.9514 6.65845 12.8167C6.65845 13.6819 7.35987 14.3833 8.22511 14.3833Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M14.4834 12.5083C15.3487 12.5083 16.0501 11.8069 16.0501 10.9417C16.0501 10.0764 15.3487 9.375 14.4834 9.375C13.6182 9.375 12.9167 10.0764 12.9167 10.9417C12.9167 11.8069 13.6182 12.5083 14.4834 12.5083Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M9.79186 12.8167V7.29166C9.78836 7.03177 9.86705 6.77741 10.0167 6.56491C10.1664 6.3524 10.3793 6.1926 10.6252 6.10833L14.3752 5.06666C14.5623 5.00212 14.7622 4.98357 14.9581 5.01258C15.1539 5.04159 15.3398 5.11731 15.5002 5.23333C15.6598 5.3506 15.7897 5.50366 15.8794 5.68023C15.9691 5.85679 16.0162 6.05194 16.0169 6.24999V10.9417" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
                <defs>
                    <clipPath id="clip0_52_568">
                        <rect width="20" height="20" fill="white"></rect>
                    </clipPath>
                </defs>
            </svg>
        </div>
        <div class="playlist-item__title text-big">${playlist?.title}</div>
    </a>`;
    };

    if (!playlistFilter || !allInputs) return;

    const values = {};
    const pagination = document.querySelector('.pagination');

    allInputs?.forEach(elem => {
        values[elem?.name] = '';

        Object.defineProperty(elem, 'value', {
            set: throttle(function (newValue) {
                values[this?.name] = newValue;

                const covertUrl = objConvertUrl(values);

                window.history.replaceState(null, null, covertUrl);
                myFetch('/api/playlist' + covertUrl)
                    .then(res => {
                        if (!res?.ok) return;

                        return res.json()
                    })
                    .then(res => {
                        playlistList.innerHTML = "";

                        const data = res?.data?.data;

                        if (!data?.length) {
                            playlistList.innerHTML = '<h3 class="playlist__none">Playlist not found</h3>';
                            return;
                        }

                        if (pagination) pagination.innerHTML = res?.links_html;

                        data?.forEach(playlist => {
                            playlistList.insertAdjacentHTML('beforeend', playlistItem(playlist));
                        });

                    });
            }, 500)
        });
    });
})();

(function () {
    const headerMobileBurger = document.querySelector('.header-mobile__burger');
    const headerMobileModal = document.querySelector('.header-mobile__modal');
    const headerMobileClose = document.querySelector('.header-mobile__close');

    if (!headerMobileBurger || !headerMobileBurger) return;

    headerMobileBurger.onclick = () => {
        addClass(headerMobileModal, '_active');
    }

    headerMobileClose.onclick = () => {
        removeClass(headerMobileModal, '_active');
    }
})();