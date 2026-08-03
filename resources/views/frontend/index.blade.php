<!doctype html>
<html class="no-js" lang="en">

<head>
    @include('components.frontend.head')
</head>

<body class="tp-magic-cursor loaded">
    @include('components.frontend.header')


    <div id="smooth-wrapper">
        <div id="smooth-content">
            <main>
                <!-- hero area start -->
                @if($banner)
                <div class="al-hero-area al-hero-shop-spacing fix p-relative z-index-1">
                    <div class="swiper-container al-hero-shop-active">
                        <div class="swiper-wrapper">

                            <!-- Slide 1 -->
                            <div class="swiper-slide al-hero-shop-item p-relative d-flex align-items-center"
                                data-bg-color="#f5f8fc">

                                @if($banner->video)
                                <video class="hero-bg-video"
                                    src="{{ asset('home/banner/' . $banner->video) }}" autoplay muted loop
                                    playsinline></video>
                                @endif

                                <div class="container">
                                    <div class="row align-items-center">

                                        <div class="col-xl-6 col-lg-6 col-md-8">
                                            <div class="al-hero-shop-content">

                                                <h3 class="al-hero-shop-title tp-text-common-white">
                                                    {!! strip_tags($banner->heading, '<br><b><strong><i><em><u><a><span>') !!}
                                                </h3>
                                            

                                                <p class="mb-35 tp-text-common-white">
                                                    {!! strip_tags($banner->title, '<br><b><strong><i><em><u><a><span>') !!}
                                                </p>

                                                <div class="cst-hero-btn-box">
                                                    <div class="cst-hero-btn tp_fade_anim" data-delay=".5"
                                                        style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">
                                                        <a class="cst-btn" href="#">
                                                            <span>
                                                                <span class="text-1">
                                                                    Lets Get Started
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="12" viewBox="0 0 16 12" fill="none">
                                                                        <path
                                                                            d="M0.75 4.77295C0.335786 4.77295 0 5.10874 0 5.52295C0 5.93716 0.335786 6.27295 0.75 6.27295V5.52295V4.77295ZM15.2803 6.05328C15.5732 5.76039 15.5732 5.28551 15.2803 4.99262L10.5074 0.219648C10.2145 -0.0732449 9.73959 -0.0732449 9.4467 0.219648C9.15381 0.512542 9.15381 0.987415 9.4467 1.28031L13.6893 5.52295L9.4467 9.76559C9.15381 10.0585 9.15381 10.5334 9.4467 10.8263C9.73959 11.1191 10.2145 11.1191 10.5074 10.8263L15.2803 6.05328ZM0.75 5.52295V6.27295H14.75V5.52295V4.77295H0.75V5.52295Z"
                                                                            fill="black"></path>
                                                                    </svg>
                                                                </span>
                                                                <span class="text-2">
                                                                    Lets Get Started
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="12" viewBox="0 0 16 12" fill="none">
                                                                        <path
                                                                            d="M0.75 4.77295C0.335786 4.77295 0 5.10874 0 5.52295C0 5.93716 0.335786 6.27295 0.75 6.27295V5.52295V4.77295ZM15.2803 6.05328C15.5732 5.76039 15.5732 5.28551 15.2803 4.99262L10.5074 0.219648C10.2145 -0.0732449 9.73959 -0.0732449 9.4467 0.219648C9.15381 0.512542 9.15381 0.987415 9.4467 1.28031L13.6893 5.52295L9.4467 9.76559C9.15381 10.0585 9.15381 10.5334 9.4467 10.8263C9.73959 11.1191 10.2145 11.1191 10.5074 10.8263L15.2803 6.05328ZM0.75 5.52295V6.27295H14.75V5.52295V4.77295H0.75V5.52295Z"
                                                                            fill="black"></path>
                                                                    </svg>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="cst-hero-btn tp_fade_anim" data-delay=".7"
                                                        style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">
                                                        <a class="cst-btn transparent" href="#">
                                                            <span>
                                                                <span class="text-1">Schedule a Call</span>
                                                                <span class="text-2">Schedule a Call</span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                @endif
                <!-- hero area end -->
                <!-- about area start -->
                <!-- tp-portfolio-area-start -->
                <!-- Product Area Start -->
                @if($productIntro)
                <div class="tp-portfolio-area pt-90 pb-90 tp-panel-pin-area">
                    <div class="container">
                        <div class="row">

                            <!-- Left Content -->
                            <div class="col-lg-5">
                                <div class="tp-portfolio-sa-title-wrap mb-40 tp-panel-pin">

                                    <span class="cnt-section-subtitle mb-20 tp_fade_anim" data-delay=".3">
                                        {{ $productIntro->heading }}
                                    </span>

                                    <h2
                                        class="tp-about-2-title fs-md-40 fs-xs-30 tp-ff-dm fw-600">
                                        {!! strip_tags($productIntro->title, '<br><b><strong><i><em><u><a><span>') !!}
                                    </h2>

                                    <div class="mb-30">
                                        {!! $productIntro->description !!}
                                    </div>

                                    @if($productIntro->qualities->isNotEmpty())
                                    <div class="tp-portfolio-tag tp_fade_anim" data-delay=".7">
                                        @foreach($productIntro->qualities as $quality)
                                        <span>{{ $quality->quality }}</span>
                                        @endforeach
                                    </div>
                                    @endif

                                    <div class="tp-portfolio-pp-border mt-30 mb-60">
                                        <span>
                                            <svg viewBox="0 0 424 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5 2.5L0 0.113249V5.88675L5 3.5V2.5ZM419 3.5L424 5.88675V0.113249L419 2.5V3.5ZM4.5 3.5H419.5V2.5H4.5V3.5Z"
                                                    fill="#EEEEEE" />
                                            </svg>
                                        </span>
                                    </div>

                                                                       <div class="tp-rounded-btn-wrap tp-about-wd-btn tp_fade_anim" data-delay=".5"
                                        data-fade-from="top" data-ease="bounce">

                                        <div class="btn_wrapper d-inline-block">

                                            <a href="#" class="tp-btn-rounded btn-item">
                                                View All Products
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

                            <!-- Right Products -->
                            <div class="col-lg-7">
                                <div class="tp-portfolio-pp-item-wrap">

                                    <!-- Product 1 -->
                                    <div class="tp-portfolio-2-item mb-65 tp-panel-pin tp-bg-common-white">
                                        <div class="tp-portfolio-overlay"></div>
                                        <div class="not-hide-cursor" data-cursor="View Product">
                                            <a href="#" class="d-block tp-portfolio-2-thumb mb-20 cursor-hide">
                                                <img class="w-100" src="{{ asset('frontend/assets/images/products/1.webp') }}"
                                                    alt="Welding Consumables">
                                            </a>
                                        </div>

                                        <div
                                            class="tp-portfolio-2-content tp-portfolio-pp-content d-flex justify-content-between align-items-start">
                                            <div>
                                                <h3 class="tp-portfolio-title fw-700 fs-25 lh-36 mb-10">
                                                    <a class="underline-black" href="#">
                                                        Welding Consumables
                                                    </a>
                                                </h3>

                                                <div class="tp-portfolio-tag">
                                                    <span>Electrodes • Wires • Fluxes</span>
                                                </div>
                                            </div>

                                            <div class="tp-portfolio-tag">
                                                <span>01</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Product 2 -->
                                    <div class="tp-portfolio-2-item mb-65 tp-panel-pin tp-bg-common-white">
                                        <div class="tp-portfolio-overlay"></div>
                                        <div class="not-hide-cursor" data-cursor="View Product">
                                            <a href="thermal-spray-#"
                                                class="d-block tp-portfolio-2-thumb mb-20 cursor-hide">
                                                <img class="w-100" src="{{ asset('frontend/assets/images/products/2.webp') }}"
                                                    alt="Thermal Spray Products">
                                            </a>
                                        </div>

                                        <div
                                            class="tp-portfolio-2-content tp-portfolio-pp-content d-flex justify-content-between align-items-start">
                                            <div>
                                                <h3 class="tp-portfolio-title fw-700 fs-25 lh-36 mb-10">
                                                    <a class="underline-black" href="thermal-spray-#">
                                                        Thermal Spray Products
                                                    </a>
                                                </h3>

                                                <div class="tp-portfolio-tag">
                                                    <span>Powders • Wires • Coatings</span>
                                                </div>
                                            </div>

                                            <div class="tp-portfolio-tag">
                                                <span>02</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Product 3 -->
                                    <div class="tp-portfolio-2-item mb-65 tp-panel-pin tp-bg-common-white">
                                        <div class="tp-portfolio-overlay"></div>
                                        <div class="not-hide-cursor" data-cursor="View Product">
                                            <a href="#" class="d-block tp-portfolio-2-thumb mb-20 cursor-hide">
                                                <img class="w-100" src="{{ asset('frontend/assets/images/products/3.webp') }}"
                                                    alt="Additive Manufacturing">
                                            </a>
                                        </div>

                                        <div
                                            class="tp-portfolio-2-content tp-portfolio-pp-content d-flex justify-content-between align-items-start">
                                            <div>
                                                <h3 class="tp-portfolio-title fw-700 fs-25 lh-36 mb-10">
                                                    <a class="underline-black" href="#">
                                                        Additive Manufacturing
                                                    </a>
                                                </h3>

                                                <div class="tp-portfolio-tag">
                                                    <span>Metal 3D Printing Solutions</span>
                                                </div>
                                            </div>

                                            <div class="tp-portfolio-tag">
                                                <span>03</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Product 4 -->
                                    <div class="tp-portfolio-2-item mb-65 tp-panel-pin tp-bg-common-white">
                                        <div class="tp-portfolio-overlay"></div>
                                        <div class="not-hide-cursor" data-cursor="View Product">
                                            <a href="#" class="d-block tp-portfolio-2-thumb mb-20 cursor-hide">
                                                <img class="w-100" src="{{ asset('frontend/assets/images/products/4.webp') }}"
                                                    alt="Welding Equipments">
                                            </a>
                                        </div>

                                        <div
                                            class="tp-portfolio-2-content tp-portfolio-pp-content d-flex justify-content-between align-items-start">
                                            <div>
                                                <h3 class="tp-portfolio-title fw-700 fs-25 lh-36 mb-10">
                                                    <a class="underline-black" href="#">
                                                        Welding Equipments
                                                    </a>
                                                </h3>

                                                <div class="tp-portfolio-tag">
                                                    <span>MIG • TIG • ARC • Plasma</span>
                                                </div>
                                            </div>

                                            <div class="tp-portfolio-tag">
                                                <span>04</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Product 5 -->
                                    <div class="tp-portfolio-2-item mb-65 tp-panel-pin tp-bg-common-white">
                                        <div class="not-hide-cursor" data-cursor="View Product">
                                            <a href="#" class="d-block tp-portfolio-2-thumb mb-20 cursor-hide">
                                                <img class="w-100" src="{{ asset('frontend/assets/images/products/5.webp') }}"
                                                    alt="Special Products">
                                            </a>
                                        </div>

                                        <div
                                            class="tp-portfolio-2-content tp-portfolio-pp-content d-flex justify-content-between align-items-start">
                                            <div>
                                                <h3 class="tp-portfolio-title fw-700 fs-25 lh-36 mb-10">
                                                    <a class="underline-black" href="#">
                                                        Special Products
                                                    </a>
                                                </h3>

                                                <div class="tp-portfolio-tag">
                                                    <span>Industrial Welding Solutions</span>
                                                </div>
                                            </div>

                                            <div class="tp-portfolio-tag">
                                                <span>05</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endif
                <!-- Product Area End -->
                <!-- tp-portfolio-area-end -->

                <!-- tp-counter-area-start -->
                <!-- funfact area start -->
                @if($companyStats && $companyStats->items->isNotEmpty())
                <div class="ar-funfact-area ar-funfact-bg mb-0"
                    style="background-image: url('{{ asset('frontend/assets/images/hero-bg-shape.webp') }}');">
                    <div class="container container-1350">
                        <div class="row">
                            @foreach($companyStats->items as $stat)
                            <div class="col-lg-3 col-md-4">
                                <div class="ar-funfact-item text-center mb-45 tp_fade_anim" data-delay=".3">
                                    <h4>{{ $stat->stat_no }}</h4>
                                    <span>{{ $stat->stat_name }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                <!-- funfact area end -->
                <!-- Section Heading -->
                @if($companyStats && $companyStats->video)
                <div class="tp-video-vp-area tp-video-brand-img-wrap-2 fix">
                    <div class="container-fluid container-1830 p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tp-video-vp-wrap">
                                    <div class="tp-video-vp-img-inner-2" id="video">
                                        <video loop="" muted="" autoplay="" playsinline=""
                                            style="translate: none; rotate: none; scale: none; border-radius: 50rem; transform: translate(0px, -334.66px) scale(0.14, 0.14);">
                                            <source
                                                src="{{ asset('home/company-stats/' . $companyStats->video) }}"
                                                type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- About Area Start -->
                @if($about)
                <div class="ar-about-area cnt-about-style p-relative pt-90 pb-90">
                    @if($about->image3)
                    <img class="ar-about-shape" src="{{ asset('home/about/' . $about->image3) }}" alt="About Weldwell">
                    @endif

                    <div class="container">

                        <!-- Section Heading -->
                        <div class="ar-about-title-wrap mb-60">
                            <div class="row align-items-end">

                                <div class="col-xl-8 col-lg-8">
                                    <div class="tp-about-cst-title-wrap mb-80">

                                        <span class="cnt-section-subtitle mb-20 tp_fade_anim" data-delay=".3">
                                            {{ $about->heading }}
                                        </span>

                                        <h2
                                            class="tp-about-2-title fs-md-40 fs-xs-30 tp-ff-dm fw-600">
                                            {!! strip_tags($about->title, '<br><b><strong><i><em><u><a><span>') !!}
                                        </h2>

                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 d-none d-lg-block">
                                    <div class="ar-about-top-img text-end">
                                        @if($about->image1)
                                        <img data-speed=".9" src="{{ asset('home/about/' . $about->image1) }}" alt="About Weldwell">
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row align-items-end">

                            <!-- Left Image -->
                            <div class="col-xl-4 col-lg-5 col-md-7">
                                <div class="ar-about-thumb p-relative">
                                    @if($about->image2)
                                    <img data-speed=".9" src="{{ asset('home/about/' . $about->image2) }}"
                                        alt="Weldwell Welding Solutions">
                                    @endif
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="col-xl-5 col-lg-5 col-md-10 order-1 order-lg-0">

                                <div class="ar-about-content">

                                    <div class="ar-about-title-sm tp_fade_anim" data-delay=".3">
                                        {!! strip_tags($about->small_intro, '<br><b><strong><i><em><u><a><span>') !!}
                                    </div>

                                    <div class="tp_fade_anim" data-delay=".4">
                                        {!! $about->description !!}
                                    </div>
                                    <!-- Button -->
                                    <div class="tp-rounded-btn-wrap tp-about-wd-btn tp_fade_anim" data-delay=".5"
                                        data-fade-from="top" data-ease="bounce">

                                        <div class="btn_wrapper d-inline-block">

                                            <a href="#" class="tp-btn-rounded btn-item">
                                                Learn More About Us
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

                            <!-- Experience Box -->
                            <div class="col-xl-3 col-lg-3 col-md-5 order-0 order-lg-0">

                                <div data-speed="1.1"
                                    class="ar-about-exp-wrap d-flex justify-content-xxl-start justify-content-end">

                                    <div class="ar-about-exp-box">

                                        <span>{{ $about->experience_title }}</span>

                                        <h4>{{ $about->experience }}</h4>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
                @endif
                <!-- About Area End -->
                <!-- about area end -->



                <!-- brand area start -->
                @if($clients && $clients->photos->isNotEmpty())
                <div class="dgm-brand-area fix">
                    <div class="dgm-brand-wrapper cst-border-b">
                        <div class="swiper-container dgm-brand-active">
                            <div class="swiper-wrapper">
                                @foreach($clients->photos as $photo)
                                <div class="swiper-slide">
                                    <div class="dgm-brand-item">
                                        <img src="{{ asset('home/clients/' . $photo->photo) }}" alt="">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- brand area end -->


                <!-- tp-banner-area-start -->
                <div class="tp-banner-ai-thumb section-triger">
                    <div class="box h-100">
                        <img data-speed=".8" class="img-cover myimg" src="{{ asset('frontend/assets/images/3842.jpg') }}" alt="">
                        <div class="uncover">
                            <div class="uncover_slice"></div>
                            <div class="uncover_slice"></div>
                            <div class="uncover_slice"></div>
                        </div>
                    </div>
                </div>

                <!-- testimonial area start -->
                <!-- tp-counter-area-end -->
                <!-- testimonial area start -->
                 
                @if($testimony)
                <div class="ar-testimonial-area pt-90 pb-90">
                    <div class="container container-1350">
                        <div class="cnt-portfolio-heading text-center pb-80">

                            <span class="cnt-section-subtitle mb-20 tp_fade_anim" data-delay=".3">
                                {{ $testimony->heading }}
                            </span>

                            <h2
                                class="tp-about-2-title fs-md-40 fs-xs-30 tp-ff-dm fw-600">
                                {!! strip_tags($testimony->title, '<br><b><strong><i><em><u><a><span>') !!}
                            </h2>


                        </div>
                        <div class="row justify-content-center">
                            <div class="col-xl-8">
                                <div class="ar-testimonial-slider-wrap p-relative">
                                    <!-- <div class="ar-testimonial-shape-1">
                                        <img src="assets/img/update-2/testimonial/test-bg-1.png" alt="">
                                    </div> -->
                                    <div class="swiper-container ar-testimonial-active fix">
                                        <div class="swiper-wrapper">
                                            @foreach(($testimonials ?? collect()) as $t)
                                            <div class="swiper-slide">
                                                <div class="ar-testimonial-item text-center">
                                                    {!! $t->testimony !!}
                                                    <h5 class="mt-30 mb-0">{{ $t->client_name }}</h5>
                                                    <span>{{ $t->industry_type }}</span>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="fraction-wrapper d-none d-lg-block">
                                        <div id="paginations"></div>
                                        <div class="shop-slider-progress-bar">
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="ar-testimonial-arrow">
                                        <button class="ar-testimonial-prev">
                                            <span>
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13 7H1M1 7L7 1M1 7L7 13" stroke="currentcolor"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </button>
                                        <button class="ar-testimonial-next">
                                            <span>
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 7H13M13 7L7 1M13 7L7 13" stroke="currentcolor"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- testimonial area end -->

                <!-- text slider area start -->
                @if($testimony && $testimony->sliders->isNotEmpty())
                <div class="crp-text-slider-wrap pb-50 p-relative">

                    <div class="crp-text-shape-wrap app">
                        <!-- <img class="crp-text-shape-1" src="assets/img/update-2/text-slider/text-slide-2.png" alt="">
                        <img class="crp-text-shape-2 tp-live-anim-spin" src="assets/img/update-2/text-slider/text-slider-shape-1.png" alt=""> -->
                    </div>

                    <div class="swiper-container app-text-slider-color crp-text-slider-active pb-0">
                        <div class="swiper-wrapper slide-transtion">

                            @foreach($testimony->sliders as $slider)
                            <div class="swiper-slide">
                                <div class="crp-text-slider-item {{ $loop->odd ? 'stroke-text' : '' }}">
                                    <span>{{ $slider->title }}</span>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                </div>
                @endif
                <!-- text slider area end -->


                <!-- project area start -->
                @if($knowledge)
                <div class="al-project-seo-area knowledge-area pt-90 pb-90">
                    <div class="knowledge-bg">
                        @if($knowledge->background_image)
                        <img src="{{ asset('home/knowledge/' . $knowledge->background_image) }}" alt="">
                        @endif
                    </div>
                    <div class="container">

                        <!-- Section Title -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="al-project-seo-title-box text-center mb-65">
                                    <span class="cnt-section-subtitle mb-20 tp_fade_anim" data-delay=".3">
                                        {{ $knowledge->title }}
                                    </span>

                                    <h2 class="tp-section-pp-title fw-400 fs-md-40 fs-xs-30 lh-120-per tp-text-common-white tp_text_invert">
                                        {!! strip_tags($knowledge->heading, '<br><b><strong><i><em><u><a><span>') !!}
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12">

                                <!-- 2025 -->
                                <div class="al-project-seo-item mb-10">
                                    <div class="row align-items-center">

                                        <div class="col-xl-7 col-lg-6">
                                            <div class="al-project-seo-title-box">
                                                <h4 class="al-project-seo-title">
                                                    <a href="#">
                                                        Weldwell Spectrum <br>
                                                        2025 Edition
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>

                                        <div class="col-xl-5 col-lg-6">
                                            <div class="al-project-seo-content d-flex align-items-center justify-content-between">

                                                <div class="al-project-seo-info">
                                                    <h5>Latest Technical Journal</h5>
                                                    <span>
                                                        Volume 32 <br>
                                                        Issues 1-4
                                                    </span>
                                                </div>

                                                <div class="al-project-seo-btn">
                                                    <a href="#">
                                                        <span>
                                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                                                <path d="M1 11L11 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                                                <path d="M1 1H11V11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- 2024 -->
                                <div class="al-project-seo-item mb-10">
                                    <div class="row align-items-center">

                                        <div class="col-xl-7 col-lg-6">
                                            <h4 class="al-project-seo-title">
                                                <a href="#">
                                                    Weldwell Spectrum <br>
                                                    2024 Edition
                                                </a>
                                            </h4>
                                        </div>

                                        <div class="col-xl-5 col-lg-6">
                                            <div class="al-project-seo-content d-flex align-items-center justify-content-between">

                                                <div class="al-project-seo-info">
                                                    <h5>Technical Magazine</h5>
                                                    <span>
                                                        Welding Technology <br>
                                                        Industry Insights
                                                    </span>
                                                </div>

                                                <div class="al-project-seo-btn">
                                                    <a href="#">
                                                        <span>
                                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                                                <path d="M1 11L11 1" stroke="currentColor" stroke-width="1.5"/>
                                                                <path d="M1 1H11V11" stroke="currentColor" stroke-width="1.5"/>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <!-- Button -->
                            <div class="col-xl-12 text-center">
                                <div class="tp-rounded-btn-wrap tp-about-wd-btn mt-30 tp_fade_anim" data-delay=".5"
                                    data-fade-from="top" data-ease="bounce">

                                    <div class="btn_wrapper d-inline-block">

                                        <a href="#" class="tp-btn-rounded btn-item">

                                            Browse All Editions
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

                    </div>
                </div>
                @endif
                <!-- project area end -->

                <!-- tp-cta-area-start -->
                @if($connection)
                <div class="tp-cta-area bg-position p-relative pb-90 pt-90 tp-bg-common-white-2 fix">
                    <div class="tp-cta-wd-shape">
                        <svg viewBox="0 0 733 448" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="line-1" d="M31.5 466.5L259 55.5L456 222L772.5 34" stroke="white"
                                stroke-width="71" />
                        </svg>
                    </div>

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-8">
                                <div class="tp-cta-wd-content text-center p-relative mb-30">

                                    <span
                                        class="tp-footer-top-subtitle tp-text-common-white fw-500 fs-18 mb-10 d-inline-block tp_fade_anim"
                                        data-delay=".3">
                                        {{ $connection->title }}
                                    </span>

                                    <h2
                                        class="tp-footer-top-title tp-text-common-white text-uppercase fw-600 mb-40 rotate-text-anim">
                                        {!! strip_tags($connection->heading, '<br><b><strong><i><em><u><a><span>') !!}
                                    </h2>

                                    @if($connection->email)
                                    <div class="tp_fade_anim" data-delay=".5">
                                        <a class="tp-cta-wd-email d-inline-block fs-35 fs-xs-25 fw-600 tp-text-common-white"
                                            href="mailto:{{ $connection->email }}">
                                            {{ $connection->email }}
                                        </a>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- tp-cta-area-end -->

                <!-- blog area start -->
                @if($event)
                <div class="al-blog-seo-area grey-bg-3 pt-90 pb-90" data-bg-color="#eff1f2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="al-blog-seo-title-box text-center mb-40">
                            <span class="cnt-section-subtitle mb-20 tp_fade_anim" data-delay=".3">
                                {{ $event->heading }}
                            </span>

                            <h2 class="tp-about-2-title fs-md-40 fs-xs-30 tp-ff-dm fw-600">
                                {!! strip_tags($event->title, '<br><b><strong><i><em><u><a><span>') !!}
                            </h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        @foreach(($events ?? collect()) as $ev)
                        <div class="col-xl-4 col-lg-4 col-md-6 mb-30 tp_fade_anim" data-delay=".3">
                            <div class="al-blog-seo-item">

                            <div class="al-blog-seo-content mb-20">
                                @if(!empty($ev->tags))
                                <div class="al-blog-seo-category">
                                    @foreach($ev->tags as $tag)
                                    <a href="#">{{ $tag }}</a>
                                    @endforeach
                                </div>
                                @endif

                                <h4 class="al-blog-seo-title">
                                    <a href="#">{{ $ev->title }}</a>
                                </h4>

                                <div class="al-blog-seo-meta">
                                    <span>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="currentcolor" stroke-width="1.5"/>
                                        <path d="M8 3.8V8L10.8 9.4" stroke="currentcolor" stroke-width="1.5"/>
                                        </svg>
                                    </span>
                                    <span>{{ $ev->date ? $ev->date->format('d M Y') : 'Coming Soon' }}</span>
                                </div>
                            </div>

                            <div class="al-blog-seo-thumb fix">
                                <a href="#">
                                    @if($ev->thumbnail)
                                    <img class="w-100" src="{{ asset('events/' . $ev->thumbnail) }}" alt="{{ $ev->title }}">
                                    @endif
                                </a>
                            </div>

                            </div>
                        </div>
                        @endforeach



                    </div>
                </div>
                </div>
                @endif
                <!-- blog area end -->

            </main>

            @include('components.frontend.footer')

        </div>
    </div>

    @include('components.frontend.main-js')

</body>

</html>
