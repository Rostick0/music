@if (!auth()->check())
    <div class="banner">
        <div class="container">
            <div class="banner__container">
                <div class="banner__container_left">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_111_3907)">
                            <path d="M15 16.875V24.375" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M11.25 20.625H18.75" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M27.1875 4.6875H2.8125C1.77697 4.6875 0.9375 5.52697 0.9375 6.5625V27.1875C0.9375 28.223 1.77697 29.0625 2.8125 29.0625H27.1875C28.223 29.0625 29.0625 28.223 29.0625 27.1875V6.5625C29.0625 5.52697 28.223 4.6875 27.1875 4.6875Z"
                                stroke="white" stroke-width="2" stroke-linejoin="round" />
                            <path d="M0.9375 12.1875H29.0625" stroke="white" stroke-width="2" stroke-linejoin="round" />
                            <path d="M8.4375 7.5V0.9375" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M21.5625 7.5V0.9375" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </g>
                        <defs>
                            <clipPath id="clip0_111_3907">
                                <rect width="30" height="30" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    <div class="banner__text text-medium">Need royalty free music? Start your 30 day free trial now!
                        Cancel anytime.
                    </div>
                </div>
                <a href="" class="button-white banner__link">Star trial now</a>
            </div>
        </div>
    </div>
@endif
