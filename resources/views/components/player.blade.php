<div class="player">
    <div class="player__switch">
        <button class="player__prev">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" rx="5" fill="white" />
                <path
                    d="M26.1136 25.2972C26.3123 25.3968 26.5331 25.4439 26.7552 25.434C26.9772 25.4241 27.193 25.3576 27.3821 25.2407C27.5712 25.1239 27.7272 24.9606 27.8354 24.7665C27.9435 24.5723 28.0002 24.3537 28.0001 24.1315V15.3038C28.0002 15.0815 27.9435 14.8629 27.8354 14.6688C27.7272 14.4746 27.5712 14.3114 27.3821 14.1945C27.193 14.0777 26.9772 14.0112 26.7552 14.0013C26.5331 13.9914 26.3123 14.0385 26.1136 14.138L17.292 18.5481C17.0754 18.6564 16.8933 18.823 16.766 19.029C16.6387 19.235 16.5713 19.4724 16.5713 19.7146C16.5713 19.9568 16.6387 20.1941 16.766 20.4002C16.8933 20.6062 17.0754 20.7727 17.292 20.8811L26.1136 25.2972Z"
                    stroke="#1B121E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 14.0054V25.4343" stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
        <button class="track-button player__button">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" rx="20" fill="url(#paint0_linear_111_2751)"></rect>
                <g class="track-item__button_start">
                    <path
                        d="M15 25.509C15.0004 25.9876 15.1322 26.4559 15.3798 26.8581C15.6273 27.2602 15.9801 27.5793 16.3961 27.7771C16.812 27.9749 17.2735 28.0431 17.7254 27.9735C18.1774 27.904 18.6006 27.6996 18.9447 27.3849L27 20.0032L18.9447 12.6169C18.6008 12.3015 18.1775 12.0966 17.7254 12.0267C17.2732 11.9568 16.8114 12.0249 16.3952 12.2228C15.979 12.4207 15.6261 12.7401 15.3787 13.1426C15.1312 13.5452 14.9998 14.014 15 14.4928V25.509Z"
                        fill="white"></path>
                </g>
                <g class="track-item__button_pause">
                    <path d="M15.9998 13.6665V27.0002" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M24 13.6665V27.0002" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </g>
                <defs>
                    <linearGradient id="paint0_linear_111_2751" x1="40" y1="0" x2="-3.72369"
                        y2="4.59913" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#FF9211"></stop>
                        <stop offset="1" stop-color="#FF1111"></stop>
                    </linearGradient>
                </defs>
            </svg>
        </button>
        <div class="player__next">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" rx="5" fill="white" />
                <path
                    d="M13.8865 25.2969C13.6878 25.3964 13.4669 25.4435 13.2449 25.4336C13.0229 25.4237 12.807 25.3572 12.618 25.2404C12.4289 25.1236 12.2729 24.9603 12.1647 24.7662C12.0566 24.572 11.9998 24.3534 12 24.1312V15.3037C11.9998 15.0815 12.0566 14.8629 12.1647 14.6688C12.2729 14.4746 12.4289 14.3114 12.618 14.1945C12.807 14.0777 13.0229 14.0112 13.2449 14.0013C13.4669 13.9914 13.6878 14.0385 13.8865 14.138L22.7078 18.5479C22.9244 18.6563 23.1065 18.8228 23.2338 19.0288C23.361 19.2349 23.4285 19.4722 23.4285 19.7144C23.4285 19.9566 23.361 20.194 23.2338 20.4C23.1065 20.606 22.9244 20.7725 22.7078 20.8809L13.8865 25.2969Z"
                    stroke="#1B121E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M28 14.0054V25.4339" stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </div>
    </div>
    <div class="track-item__text player__text text-ellipsis">
        <div class="track-item__name player__name" title="Новая песня">Новая песня</div>
        <div class="track-item__artist" title="лучший">лучший</div>
    </div>
    <div class="track-time track-item__time player__time">05:11</div>
    <div class="player__audio" data-music="1690208753.mp3"></div>
    <button class="player__volume">
        <div class="player-volume">
            <div class="player-volume__status" dir="rtl">
                <input type="range" orient="vertical" />
            </div>
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12.9901 4.26984C12.7616 4.15565 12.5059 4.10735 12.2515 4.13034C11.9972 4.15333 11.7543 4.24671 11.55 4.4L5.5 8.25H2.75C2.38533 8.25 2.03559 8.39487 1.77773 8.65273C1.51987 8.91059 1.375 9.26033 1.375 9.625V12.375C1.375 12.7397 1.51987 13.0894 1.77773 13.3473C2.03559 13.6051 2.38533 13.75 2.75 13.75H5.5L11.55 17.6C11.7543 17.7532 11.9972 17.8465 12.2515 17.8694C12.5058 17.8924 12.7615 17.844 12.9899 17.7298C13.2183 17.6156 13.4104 17.4401 13.5446 17.2229C13.6789 17.0057 13.75 16.7554 13.75 16.5V5.5C13.7501 5.24461 13.679 4.99424 13.5448 4.77697C13.4106 4.55969 13.2185 4.38408 12.9901 4.26984Z"
                    stroke="#1B121E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M19.6743 14.4375C20.2945 13.4655 20.624 12.3364 20.624 11.1834C20.624 10.0303 20.2945 8.90126 19.6743 7.9292"
                    stroke="#1B121E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M17.0151 13.2376C17.4788 12.6669 17.7319 11.954 17.7319 11.2187C17.7319 10.4833 17.4788 9.77043 17.0151 9.19971"
                    stroke="#1B121E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M5.5 8.25V13.75" stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </div>
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M21.9901 13.2698C21.7616 13.1557 21.5059 13.1073 21.2515 13.1303C20.9972 13.1533 20.7543 13.2467 20.55 13.4L14.5 17.25H11.75C11.3853 17.25 11.0356 17.3949 10.7777 17.6527C10.5199 17.9106 10.375 18.2603 10.375 18.625V21.375C10.375 21.7397 10.5199 22.0894 10.7777 22.3473C11.0356 22.6051 11.3853 22.75 11.75 22.75H14.5L20.55 26.6C20.7543 26.7532 20.9972 26.8465 21.2515 26.8694C21.5058 26.8924 21.7615 26.844 21.9899 26.7298C22.2183 26.6156 22.4104 26.4401 22.5446 26.2229C22.6789 26.0057 22.75 25.7554 22.75 25.5V14.5C22.7501 14.2446 22.679 13.9942 22.5448 13.777C22.4106 13.5597 22.2185 13.3841 21.9901 13.2698Z"
                stroke="#1B121E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M28.6743 23.4375C29.2945 22.4655 29.624 21.3364 29.624 20.1834C29.624 19.0303 29.2945 17.9013 28.6743 16.9292"
                stroke="#1B121E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M26.0151 22.2376C26.4788 21.6669 26.7319 20.954 26.7319 20.2187C26.7319 19.4833 26.4788 18.7704 26.0151 18.1997"
                stroke="#1B121E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M14.5 17.25V22.75" stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>
    </button>
    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M20.6076 11L23.3959 16.5242L28.7626 17.0558C28.8903 17.0664 29.0124 17.1134 29.1143 17.1913C29.2161 17.2691 29.2936 17.3745 29.3374 17.495C29.3813 17.6154 29.3897 17.7459 29.3616 17.871C29.3336 17.9961 29.2703 18.1106 29.1792 18.2008L24.7626 22.5783L26.4001 28.5267C26.4336 28.6528 26.4299 28.786 26.3895 28.9101C26.3492 29.0343 26.2738 29.1441 26.1724 29.2264C26.0711 29.3087 25.9482 29.36 25.8184 29.3741C25.6886 29.3882 25.5575 29.3645 25.4409 29.3058L20.0001 26.6117L14.5667 29.3025C14.4501 29.3611 14.319 29.3848 14.1893 29.3708C14.0595 29.3567 13.9365 29.3054 13.8352 29.2231C13.7339 29.1408 13.6585 29.0309 13.6181 28.9068C13.5777 28.7827 13.5741 28.6495 13.6076 28.5233L15.2451 22.575L10.8251 18.1975C10.734 18.1072 10.6707 17.9928 10.6427 17.8677C10.6147 17.7426 10.6231 17.6121 10.6669 17.4916C10.7107 17.3712 10.7882 17.2658 10.8901 17.1879C10.9919 17.1101 11.114 17.0631 11.2417 17.0525L16.6084 16.5208L19.3926 11C19.4498 10.8882 19.5369 10.7943 19.644 10.7288C19.7512 10.6632 19.8744 10.6285 20.0001 10.6285C20.1257 10.6285 20.2489 10.6632 20.3561 10.7288C20.4633 10.7943 20.5503 10.8882 20.6076 11Z"
            stroke="#1B121E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M14.375 22.5C16.1009 22.5 17.5 21.1009 17.5 19.375C17.5 17.6491 16.1009 16.25 14.375 16.25C12.6491 16.25 11.25 17.6491 11.25 19.375C11.25 21.1009 12.6491 22.5 14.375 22.5Z"
            stroke="#1B121E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path
            d="M25.625 18.125C27.3509 18.125 28.75 16.7259 28.75 15C28.75 13.2741 27.3509 11.875 25.625 11.875C23.8991 11.875 22.5 13.2741 22.5 15C22.5 16.7259 23.8991 18.125 25.625 18.125Z"
            stroke="#1B121E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path
            d="M25.625 28.125C27.3509 28.125 28.75 26.7259 28.75 25C28.75 23.2741 27.3509 21.875 25.625 21.875C23.8991 21.875 22.5 23.2741 22.5 25C22.5 26.7259 23.8991 28.125 25.625 28.125Z"
            stroke="#1B121E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M17.2886 18.2425L22.7119 16.1333" stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
            stroke-linejoin="round" />
        <path d="M17.1709 20.7733L22.8292 23.6025" stroke="#1B121E" stroke-width="1.5" stroke-linecap="round"
            stroke-linejoin="round" />
    </svg>
    <a class="button-gradient player__trial">Start free trial to download</a>
</div>
