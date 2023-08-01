@extends('layout.front.index')

@section('php')
@endsection

@section('html')
    <section class="section-page feedback">
        <div class="container">
            <div class="feedback__container">
                <h1 class="section-title-big feedback__title">Contacts</h1>
                <ul class="feedback__social">
                    <li class="feedback__social_item">
                        <a class="feedback__social_link" href="">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0 19.2C0 10.149 0 5.62355 2.81177 2.81177C5.62355 0 10.149 0 19.2 0H20.8C29.851 0 34.3764 0 37.1882 2.81177C40 5.62355 40 10.149 40 19.2V20.8C40 29.851 40 34.3764 37.1882 37.1882C34.3764 40 29.851 40 20.8 40H19.2C10.149 40 5.62355 40 2.81177 37.1882C0 34.3764 0 29.851 0 20.8V19.2Z"
                                    fill="#FF0000"></path>
                                <path d="M27.9472 19.5726L13 11V28.1453L27.9472 19.5726Z" fill="white"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="feedback__social_item">
                        <a class="feedback__social_link" href="">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_88_16)">
                                    <path
                                        d="M0 19.2C0 10.149 0 5.62355 2.81177 2.81177C5.62355 0 10.149 0 19.2 0H20.8C29.851 0 34.3764 0 37.1882 2.81177C40 5.62355 40 10.149 40 19.2V20.8C40 29.851 40 34.3764 37.1882 37.1882C34.3764 40 29.851 40 20.8 40H19.2C10.149 40 5.62355 40 2.81177 37.1882C0 34.3764 0 29.851 0 20.8V19.2Z"
                                        fill="#0077FF"></path>
                                    <path
                                        d="M21.2833 28.817C12.1666 28.817 6.96667 22.567 6.75 12.167H11.3167C11.4667 19.8003 14.8333 23.0337 17.4999 23.7003V12.167H21.8001V18.7503C24.4334 18.467 27.1997 15.467 28.1331 12.167H32.4332C31.7165 16.2337 28.7165 19.2337 26.5832 20.467C28.7165 21.467 32.1333 24.0837 33.4333 28.817H28.6998C27.6832 25.6503 25.1501 23.2003 21.8001 22.867V28.817H21.2833Z"
                                        fill="white"></path>
                                </g>
                                <defs>
                                    <clipPath id="clip0_88_16">
                                        <rect width="40" height="40" fill="white"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </li>
                    <li class="feedback__social_item">
                        <a class="feedback__social_link" href="">
                            <svg width="41" height="40" viewBox="0 0 41 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.0103 0.303223C11.7855 0.303223 9.38002 0.311708 8.91245 0.350495C7.22457 0.490798 6.17427 0.756556 5.03002 1.32625C4.14821 1.76413 3.45275 2.27171 2.76639 2.98322C1.51639 4.2808 0.758812 5.87716 0.484569 7.77474C0.351236 8.69595 0.312448 8.88383 0.304569 13.5893C0.301539 15.1578 0.304569 17.222 0.304569 19.9908C0.304569 28.209 0.31366 30.612 0.353054 31.0787C0.489418 32.7211 0.746994 33.7544 1.29245 34.8847C2.33487 37.0484 4.32578 38.6726 6.67124 39.2787C7.48336 39.4878 8.38033 39.6029 9.53184 39.6575C10.0197 39.6787 14.9924 39.6938 19.9682 39.6938C24.944 39.6938 29.9197 39.6878 30.3955 39.6635C31.7288 39.6008 32.5031 39.4969 33.3591 39.2756C35.7197 38.6666 37.6743 37.0666 38.7379 34.8726C39.2728 33.7696 39.544 32.6969 39.6667 31.1402C39.6934 30.8008 39.7046 25.3896 39.7046 19.9856C39.7046 14.5808 39.6925 9.17959 39.6658 8.84019C39.5415 7.25837 39.2703 6.19474 38.7182 5.0705C38.2652 4.15019 37.7621 3.46292 37.0318 2.76019C35.7285 1.51534 34.1346 0.757768 32.2352 0.483829C31.3149 0.350798 31.1315 0.311404 26.4224 0.303223H20.0103Z"
                                    fill="url(#paint0_radial_88_19)"></path>
                                <path
                                    d="M20.0103 0.303223C11.7855 0.303223 9.38002 0.311708 8.91245 0.350495C7.22457 0.490798 6.17427 0.756556 5.03002 1.32625C4.14821 1.76413 3.45275 2.27171 2.76639 2.98322C1.51639 4.2808 0.758812 5.87716 0.484569 7.77474C0.351236 8.69595 0.312448 8.88383 0.304569 13.5893C0.301539 15.1578 0.304569 17.222 0.304569 19.9908C0.304569 28.209 0.31366 30.612 0.353054 31.0787C0.489418 32.7211 0.746994 33.7544 1.29245 34.8847C2.33487 37.0484 4.32578 38.6726 6.67124 39.2787C7.48336 39.4878 8.38033 39.6029 9.53184 39.6575C10.0197 39.6787 14.9924 39.6938 19.9682 39.6938C24.944 39.6938 29.9197 39.6878 30.3955 39.6635C31.7288 39.6008 32.5031 39.4969 33.3591 39.2756C35.7197 38.6666 37.6743 37.0666 38.7379 34.8726C39.2728 33.7696 39.544 32.6969 39.6667 31.1402C39.6934 30.8008 39.7046 25.3896 39.7046 19.9856C39.7046 14.5808 39.6925 9.17959 39.6658 8.84019C39.5415 7.25837 39.2703 6.19474 38.7182 5.0705C38.2652 4.15019 37.7621 3.46292 37.0318 2.76019C35.7285 1.51534 34.1346 0.757768 32.2352 0.483829C31.3149 0.350798 31.1315 0.311404 26.4224 0.303223H20.0103Z"
                                    fill="url(#paint1_radial_88_19)"></path>
                                <path
                                    d="M20.0013 5.45459C16.051 5.45459 15.5552 5.47186 14.0037 5.54247C12.4552 5.61338 11.3982 5.85853 10.4734 6.21823C9.51671 6.58974 8.7052 7.08671 7.89671 7.8955C7.08762 8.70398 6.59065 9.5155 6.21792 10.4719C5.85732 11.397 5.61186 12.4543 5.54217 14.0022C5.47277 15.5537 5.45459 16.0497 5.45459 20C5.45459 23.9503 5.47217 24.4446 5.54247 25.9961C5.61368 27.5446 5.85883 28.6016 6.21823 29.5264C6.59004 30.4831 7.08701 31.2946 7.8958 32.1031C8.70398 32.9122 9.5155 33.4103 10.4716 33.7819C11.397 34.1416 12.4543 34.3867 14.0025 34.4576C15.554 34.5282 16.0494 34.5455 19.9994 34.5455C23.95 34.5455 24.4443 34.5282 25.9958 34.4576C27.5443 34.3867 28.6025 34.1416 29.5279 33.7819C30.4843 33.4103 31.2946 32.9122 32.1028 32.1031C32.9119 31.2946 33.4088 30.4831 33.7816 29.5267C34.1391 28.6016 34.3846 27.5443 34.4573 25.9964C34.527 24.4449 34.5452 23.9503 34.5452 20C34.5452 16.0497 34.527 15.554 34.4573 14.0025C34.3846 12.454 34.1391 11.397 33.7816 10.4722C33.4088 9.5155 32.9119 8.70398 32.1028 7.8955C31.2937 7.08641 30.4846 6.58944 29.527 6.21823C28.5997 5.85853 27.5422 5.61338 25.9937 5.54247C24.4422 5.47186 23.9482 5.45459 19.9967 5.45459H20.0013ZM18.6964 8.0758C19.0837 8.0752 19.5158 8.0758 20.0013 8.0758C23.8849 8.0758 24.3452 8.08974 25.8788 8.15944C27.297 8.22429 28.0667 8.46126 28.5794 8.66035C29.2582 8.92398 29.7422 9.23914 30.251 9.74823C30.76 10.2573 31.0752 10.7422 31.3394 11.421C31.5385 11.9331 31.7758 12.7028 31.8403 14.121C31.91 15.6543 31.9252 16.1149 31.9252 19.9967C31.9252 23.8785 31.91 24.3391 31.8403 25.8725C31.7755 27.2907 31.5385 28.0603 31.3394 28.5725C31.0758 29.2513 30.76 29.7346 30.251 30.2434C29.7419 30.7525 29.2585 31.0676 28.5794 31.3313C28.0673 31.5313 27.297 31.7676 25.8788 31.8325C24.3455 31.9022 23.8849 31.9173 20.0013 31.9173C16.1173 31.9173 15.657 31.9022 14.1237 31.8325C12.7055 31.767 11.9358 31.53 11.4228 31.331C10.744 31.0673 10.2591 30.7522 9.75004 30.2431C9.24095 29.734 8.9258 29.2503 8.66156 28.5713C8.46247 28.0591 8.2252 27.2894 8.16065 25.8713C8.09095 24.3379 8.07701 23.8773 8.07701 19.9931C8.07701 16.1088 8.09095 15.6507 8.16065 14.1173C8.2255 12.6991 8.46247 11.9294 8.66156 11.4167C8.9252 10.7379 9.24095 10.2531 9.75004 9.74398C10.2591 9.23489 10.744 8.91974 11.4228 8.6555C11.9355 8.4555 12.7055 8.21914 14.1237 8.15398C15.4655 8.09338 15.9855 8.0752 18.6964 8.07217V8.0758ZM27.7655 10.491C26.8019 10.491 26.02 11.2719 26.02 12.2358C26.02 13.1994 26.8019 13.9813 27.7655 13.9813C28.7291 13.9813 29.511 13.1994 29.511 12.2358C29.511 11.2722 28.7291 10.4903 27.7655 10.4903V10.491ZM20.0013 12.5303C15.8761 12.5303 12.5316 15.8749 12.5316 20C12.5316 24.1252 15.8761 27.4682 20.0013 27.4682C24.1264 27.4682 27.4697 24.1252 27.4697 20C27.4697 15.8749 24.1264 12.5303 20.0013 12.5303ZM20.0013 15.1516C22.6788 15.1516 24.8497 17.3222 24.8497 20C24.8497 22.6776 22.6788 24.8485 20.0013 24.8485C17.3234 24.8485 15.1528 22.6776 15.1528 20C15.1528 17.3222 17.3234 15.1516 20.0013 15.1516Z"
                                    fill="white"></path>
                                <defs>
                                    <radialGradient id="paint0_radial_88_19" cx="0" cy="0" r="1"
                                        gradientUnits="userSpaceOnUse"
                                        gradientTransform="translate(10.7693 42.7277) rotate(-90) scale(39.039 36.3192)">
                                        <stop stop-color="#FFDD55"></stop>
                                        <stop offset="0.1" stop-color="#FFDD55"></stop>
                                        <stop offset="0.5" stop-color="#FF543E"></stop>
                                        <stop offset="1" stop-color="#C837AB"></stop>
                                    </radialGradient>
                                    <radialGradient id="paint1_radial_88_19" cx="0" cy="0" r="1"
                                        gradientUnits="userSpaceOnUse"
                                        gradientTransform="translate(-6.29671 3.14086) rotate(78.6776) scale(17.4508 71.951)">
                                        <stop stop-color="#3771C8"></stop>
                                        <stop offset="0.128" stop-color="#3771C8"></stop>
                                        <stop offset="1" stop-color="#6600FF" stop-opacity="0"></stop>
                                    </radialGradient>
                                </defs>
                            </svg>
                        </a>
                    </li>
                    <li class="feedback__social_item">
                        <a class="feedback__social_link" href="">
                            <svg width="41" height="40" viewBox="0 0 41 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_88_23)">
                                    <path
                                        d="M16.7012 39.8C7.20122 38.1 0.0012207 29.9 0.0012207 20C0.0012207 9 9.00122 0 20.0012 0C31.0012 0 40.0012 9 40.0012 20C40.0012 29.9 32.8012 38.1 23.3012 39.8L22.2012 38.9H17.8012L16.7012 39.8Z"
                                        fill="url(#paint0_linear_88_23)"></path>
                                    <path
                                        d="M27.8013 25.5998L28.7013 19.9998H23.4013V16.0998C23.4013 14.4998 24.0013 13.2998 26.4013 13.2998H29.0013V8.1998C27.6013 7.9998 26.0013 7.7998 24.6013 7.7998C20.0013 7.7998 16.8013 10.5998 16.8013 15.5998V19.9998H11.8013V25.5998H16.8013V39.6998C17.9013 39.8998 19.0013 39.9998 20.1013 39.9998C21.2013 39.9998 22.3013 39.8998 23.4013 39.6998V25.5998H27.8013Z"
                                        fill="white"></path>
                                </g>
                                <defs>
                                    <linearGradient id="paint0_linear_88_23" x1="20.0022" y1="38.6089" x2="20.0022"
                                        y2="-0.00736777" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#0062E0"></stop>
                                        <stop offset="1" stop-color="#19AFFF"></stop>
                                    </linearGradient>
                                    <clipPath id="clip0_88_23">
                                        <rect width="40" height="40" fill="white" transform="translate(0.0012207)">
                                        </rect>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </li>
                </ul>
                <form class="feedback__form" action="{{ url()->current() }}" method="post">
                    @csrf
                    <label class="label">
                        <span class="label__name">Email</span>
                        <input class="input" type="text" name="email" value="{{ old('email') }}" maxlength="255"
                            required>
                    </label>
                    <label class="label">
                        <span class="label__name">Theme</span>
                        <input class="input" type="text" name="theme" value="{{ old('theme') }}" maxlength="255"
                            required>
                    </label>
                    <label class="label">
                        <span class="label__name">Message</span>
                        <textarea class="input" name="message" maxlength="65536" rows="5" required>{{ old('message') }}</textarea>
                    </label>
                    <button class="button-gradient feedback__button">Отправить</button>
                </form>
            </div>
        </div>
    </section>
@endsection
