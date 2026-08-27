<!doctype html>
<html class="no-js" lang="en">

<head>
    @include('components.frontend.head')
</head>

<body class="tp-magic-cursor loaded">
    @include('components.frontend.header_white')


    <div id="smooth-wrapper">
        <div id="smooth-content">
            <main>




                <!-- career hero area start -->
                <div class="tp-portfolio-colum-spacing pre-header tp-portfolio-area pb-0">
                    <div class="container containers">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="tp-service-hero-left p-relative mb-40">
                                    <h2 class="fs-70 fs-lg-60 fs-xs-40">
                                        {{ $detail?->banner_heading }}
                                    </h2>
                                    <span class="tp-service-hero-shape tpswing d-none d-sm-inline-block">
                                        <svg width="52" height="94" viewBox="0 0 52 94" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 16.1098C5.58433 24.0984 22.6118 44.5692 38.3295 38.0785C46.3521 34.5835 58.2264 23.6551 45.206 5.12554C40.2943 -1.86444 30.6673 -0.666183 25.559 14.1127C22.6118 22.6393 15.2441 43.0714 22.612 61.0456C26.5006 70.5321 38.1332 85.2111 49.1356 90.0043M49.1356 90.0043C44.0601 87.3414 32.8285 84.2126 28.5061 93M49.1356 90.0043C45.8611 88.1736 40.0979 80.8174 43.2414 66.0385M10.2322 38.0785C9.38015 41.6962 8.2675 54.4237 15.144 64.4094" stroke="#030303" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="tp-service-hero-right">
                                    <div class="fs-20 lh-140-per">{!! $detail?->description !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- career hero area end -->

                <!-- why join us area start -->
                <div class="tp-contact-us-info-area pb-120 pt-60">
                    <div class="container container-1230">
                        <div class="row justify-content-center">
                            @foreach(($detail?->benefits ?? collect()) as $benefit)
                            <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                                <div class="tp-contact-us-content text-center">
                                    <div class="tp-contact-us-bottom">
                                        <div class="tp-contact-us-info-details">
                                            <h4 class="tp-contact-us-info-title">{{ $benefit->benefit }}</h4>
                                            <p class="tp-contact-us-info-address">
                                                {{ $benefit->description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- why join us area end -->

                <!-- cta banner area start -->
                <div class="cn-contactform-support-area mb-140">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <div class="cn-contactform-support-bg d-flex align-items-center justify-content-center">
                                    <div class="cn-contactform-support-text text-center">
                                        <span>
                                            {{ $detail->section_heading }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- cta banner area end -->

                <!-- open positions area start -->
                <div class="tp-contact-us-form-ptb pre-header pb-60">
                    <div class="container container-1750 containers">
                        <div class="row mb-50">
                            <div class="tp-about-cst-title-wrap text-center">

                                <span class="cnt-section-subtitle mb-20 tp_fade_anim" data-delay=".3">
                                    {{ $detail?->career_heading }}
                                </span>

                                <h2
                                    class="tp-about-2-title fs-md-40 fs-xs-30 tp_text_invert invert-black-3 tp-ff-dm fw-600">
                                    {{ $detail?->title }}
                                </h2>

                            </div>

                        </div>

                        <div class="row">
                            @forelse($jobs as $job)
                            <div class="col-lg-6 mb-30">
                                <div class="tp-contact-us-wrap" style="border:1px solid rgba(0,0,0,0.08); padding:30px; border-radius:8px;">
                                    <h4 class="tp-contact-us-title mb-10" style="font-size:24px;">{{ $job->role_name }}</h4>
                                    <p class="fs-16 tp-ff-p mb-20">{{ $job->location }} &middot; {{ $job->job_type }}</p>
                                    <div class="fs-16 tp-ff-p lh-140-per mb-25">
                                        {!! $job->description !!}
                                    </div>
                                    <div class="tp-rounded-btn-wrap tp-about-wd-btn mt-30 tp_fade_anim" data-delay=".5"
                                        data-fade-from="top" data-ease="bounce">

                                        <div class="btn_wrapper d-inline-block">

                                            <a href="#apply" class="tp-btn-rounded btn-item">


                                                Apply Now
                                                <span class="d-block ml-15">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                                        <path d="M0.75 4.77295C0.335786 4.77295 0 5.10874 0 5.52295C0 5.93716 0.335786 6.27295 0.75 6.27295V5.52295V4.77295ZM15.2803 6.05328C15.5732 5.76039 15.5732 5.28551 15.2803 4.99262L10.5074 0.219648C10.2145 -0.0732449 9.73959 -0.0732449 9.4467 0.219648C9.15381 0.512542 9.15381 0.987415 9.4467 1.28031L13.6893 5.52295L9.4467 9.76559C9.15381 10.0585 9.15381 10.5334 9.4467 10.8263C9.73959 11.1191 10.2145 11.1191 10.5074 10.8263L15.2803 6.05328ZM0.75 5.52295V6.27295H14.75V5.52295V4.77295H0.75V5.52295Z" fill="#fff"></path>
                                                    </svg>
                                                </span>
                                                <i class="tp-btn-circle-dot"></i>

                                            </a>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12 text-center">
                                <p class="fs-18 tp-ff-p">No open positions at the moment. Please check back soon.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- open positions area end -->

                <!-- application form area start -->
                <div id="apply" class="tp-contact-us-form-ptb pre-header pb-120">
                    <div class="container container-1750 containers">
                        <div class="tp-contact-us-form-wrapper">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="tp-contact-us-wrap">
                                        <!-- <h4 class="tp-contact-us-title mb-25 text-center">Apply Now</h4> -->
                                        <div class="tp-about-cst-title-wrap pb-50 text-center">

                                            <span class="cnt-section-subtitle mb-20 tp_fade_anim" data-delay=".3">
                                                   {{ $detail?->career_heading }}
                                            </span>

                                            <h3
                                                class="tp-about-2-title fs-md-40 fs-xs-30 tp_text_invert invert-black-3 tp-ff-dm fw-600">
                                    
                                                Join Our Team
                                            </h3>

                                        </div>

                                        <form id="career-form" action="assets/mail-career.php" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="tp-postbox-details-input mb-20">
                                                        <label class="fs-18 tp-ff-p tp-text-common-black mb-10">Full name*</label>
                                                        <input class="tp-input" name="name" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="tp-postbox-details-input mb-20">
                                                        <label class="fs-18 tp-ff-p tp-text-common-black mb-10">Email address*</label>
                                                        <input class="tp-input" name="email" type="email">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="tp-postbox-details-input mb-20">
                                                        <label class="fs-18 tp-ff-p tp-text-common-black mb-10">Phone number*</label>
                                                        <input class="tp-input" name="phone" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="tp-postbox-details-input mb-20">
                                                        <label class="fs-18 tp-ff-p tp-text-common-black mb-10">Position applying for*</label>
                                                        <input class="tp-input" name="position" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="tp-postbox-details-input mb-20">
                                                        <label class="fs-18 tp-ff-p tp-text-common-black mb-10">Upload resume (PDF)*</label>
                                                        <input class="tp-input" name="resume" type="file" accept=".pdf,.doc,.docx">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="tp-postbox-details-input mb-40">
                                                        <label class="fs-18 tp-ff-p tp-text-common-black mb-10">Tell us about yourself</label>
                                                        <textarea class="tp-input tp-textarea" name="message"></textarea>
                                                    </div>
                                                    <div class="tp-contact-form-btn">
                                                        <button type="submit" class="tp-btn-rounded btn-item tp-btn-xl w-100 d-inline-block lh-0 tp-round-26 fs-15 tp-bg-common-black text-uppercase ls-0 tp-btn-switch-animation tp-text-common-white hover-text-white tp-ff-heading fw-500">

                                                            <span class="d-flex align-items-center justify-content-center">
                                                                <span class="btn-text">Submit Application</span>

                                                                <span class="d-block ml-15">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none">
                                                                        <path d="M0.75 4.77295C0.335786 4.77295 0 5.10874 0 5.52295C0 5.93716 0.335786 6.27295 0.75 6.27295V5.52295V4.77295ZM15.2803 6.05328C15.5732 5.76039 15.5732 5.28551 15.2803 4.99262L10.5074 0.219648C10.2145 -0.0732449 9.73959 -0.0732449 9.4467 0.219648C9.15381 0.512542 9.15381 0.987415 9.4467 1.28031L13.6893 5.52295L9.4467 9.76559C9.15381 10.0585 9.15381 10.5334 9.4467 10.8263C9.73959 11.1191 10.2145 11.1191 10.5074 10.8263L15.2803 6.05328ZM0.75 5.52295V6.27295H14.75V5.52295V4.77295H0.75V5.52295Z" fill="#fff" />
                                                                    </svg>
                                                                </span>
                                                            </span>

                                                            <i class="tp-btn-circle-dot"></i>

                                                        </button>
                                                        <p class="ajax-response mt-5"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- application form area end -->

                <!-- text slider area start -->
                <div class="tp-text-slider-area pt-25 pb-25 tp-bg-theme-primary">
                    <div class="swiper-container tp-text-slider-active">
                        <div class="swiper-wrapper slide-transtion">

                            @foreach(($customer?->highlights ?? collect()) as $hl)
                            <div class="swiper-slide">
                                <div class="tp-text-slider-item">
                                    <span>{{ $hl->highlight_name }}</span>
                                    <span class="icons">
                                        <svg width="68" height="12" viewBox="0 0 68 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M59.416 11.8926L67.62 6.76034C67.7367 6.67779 67.8325 6.56504 67.8989 6.43228C67.9652 6.29953 67.9999 6.15095 67.9999 6C67.9999 5.84905 67.9652 5.70048 67.8989 5.56772C67.8325 5.43496 67.7367 5.32221 67.62 5.23966L59.416 0.107354C59.2561 0.0134291 59.0719 -0.0202036 58.8925 0.0117582C58.713 0.04372 58.5485 0.139459 58.4248 0.28388C58.3011 0.428302 58.2254 0.613192 58.2094 0.809402C58.1935 1.00561 58.2383 1.20198 58.3369 1.36755L60.7161 5.11998L0.812592 5.11998C0.597076 5.11998 0.390396 5.21269 0.238007 5.37773C0.0856171 5.54277 0 5.7666 0 6C0 6.2334 0.0856171 6.45724 0.238007 6.62227C0.390396 6.78731 0.597076 6.88003 0.812592 6.88003C0.812592 6.88003 49.0381 6.88003 60.7161 6.88003L58.3369 10.6325C58.2383 10.798 58.1935 10.9944 58.2094 11.1906C58.2254 11.3868 58.3011 11.5717 58.4248 11.7161C58.5485 11.8605 58.713 11.9563 58.8925 11.9882C59.0719 12.0202 59.2561 11.9866 59.416 11.8926Z" fill="#030303" />
                                        </svg>
                                    </span>
                                    <span class="borders"></span>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <!-- text slider area end -->


            </main>

            @include('components.frontend.footer')

        </div>
    </div>

    @include('components.frontend.main-js')

</body>

</html>