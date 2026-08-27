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

                <!-- tp-blog-hero-area-start -->
                <div class="tp-portfolio-colum-spacing pre-header tp-portfolio-area pb-0 tsp-hero-banner" data-bg="{{ $detail && $detail->banner_image ? asset('product/details/banner/' . $detail->banner_image) : asset('assets/images/products/banner.webp') }}">
                    <div class="tsp-hero-banner-overlay"></div>
                    <div class="container containers">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="tp-service-hero-left p-relative mb-40">
                                    <h2 class="fs-70 fs-lg-60 fs-xs-40">
                                        {{ $category->name }}
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
                                    <p class="fs-20 lh-140-per">{{ $detail?->banner_description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tp-breadcrumb-wrap">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="tp-breadcrumb-list">
                                        <ul>
                                            <li><a href="{{ route('frontend.index') }}">Home</a></li>
                                            <li><span></span></li>
                                            <li>Product</li>
                                            <li><span></span></li>
                                            <li>{{ $category->name }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tp-blog-hero-area-end -->

                <!-- tsp-about-area-start -->
                <div class="tsp-about-area pb-90 pt-90 tsp-panel">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <span class="cnt-section-subtitle mb-20 tp_fade_anim" data-delay=".3">
                                   {{ $detail?->section_heading }}
                                </span>

                                <h2
                                    class="tp-about-2-title fs-md-40 fs-xs-30 tp_text_invert invert-black-3 tp-ff-dm fw-600">
                                    {{ $category->name }}
                                </h2>

                                <div class="tsp-about-lines mt-20">
                                    {!! $detail?->section_description !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="tsp-about-media">
                                    <img src="{{ $detail && $detail->section_image ? asset('product/details/section/' . $detail->section_image) : asset('assets/images/products/thermal-spray.webp') }}" alt="{{ $category->name }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tsp-about-area-end -->

                <div class="tsp-box-area pb-90 pt-90">
                    <div class="container">
                        <div class="cnt-portfolio-heading text-center pb-80">

                            <span class="cnt-section-subtitle mb-20 tp_fade_anim" data-delay=".3">
                                {{ $detail?->product_range_title }}
                            </span>

                            <h2
                                class="tp-about-2-title fs-md-40 fs-xs-30 tp_text_invert invert-black-3 tp-ff-dm fw-600">
                                {{ $detail?->product_range_heading }}
                            </h2>


                        </div>
                        <div class="tsp-box-grid">

                            <div class="tsp-box">
                                <div class="tsp-box-top">
                                    <span class="tsp-box-icon"><i class="bi bi-cloud-haze2"></i></span>
                                    <span class="tsp-box-num">01</span>
                                </div>
                                <h3 class="tsp-box-title">Thermal Spray Powders</h3>
                                <p class="tsp-box-copy">Engineered metal, ceramic and carbide powders formulated for coatings that resist wear, heat and corrosion.</p>
                                <div class="tp-rounded-btn-wrap tp-about-wd-btn tp_fade_anim" data-delay=".5"
                                    data-fade-from="top" data-ease="bounce">

                                    <div class="btn_wrapper d-inline-block">

                                        <a href="#" class="tp-btn-rounded btn-item">



                                            Learn More

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

                            <div class="tsp-box">
                                <div class="tsp-box-top">
                                    <span class="tsp-box-icon"><i class="bi bi-lightning-charge"></i></span>
                                    <span class="tsp-box-num">02</span>
                                </div>
                                <h3 class="tsp-box-title">Thermal Spray Wires</h3>
                                <p class="tsp-box-copy">Precision-drawn wires for arc and flame spray processes, delivering consistent feed and dense, well-bonded coatings.</p>
                                <div class="tp-rounded-btn-wrap tp-about-wd-btn tp_fade_anim" data-delay=".5"
                                    data-fade-from="top" data-ease="bounce">

                                    <div class="btn_wrapper d-inline-block">

                                        <a href="#" class="tp-btn-rounded btn-item">



                                            Learn More

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

                            <div class="tsp-box">
                                <div class="tsp-box-top">
                                    <span class="tsp-box-icon"><i class="bi bi-link-45deg"></i></span>
                                    <span class="tsp-box-num">03</span>
                                </div>
                                <h3 class="tsp-box-title">Tungsten Carbide Flexible Rope</h3>
                                <p class="tsp-box-copy">Flexible tungsten carbide rope for rebuilding and hardfacing worn components on-site, no spray booth required.</p>
                                <div class="tp-rounded-btn-wrap tp-about-wd-btn tp_fade_anim" data-delay=".5"
                                    data-fade-from="top" data-ease="bounce">

                                    <div class="btn_wrapper d-inline-block">

                                        <a href="#" class="tp-btn-rounded btn-item">



                                            Learn More

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

                            <div class="tsp-box">
                                <div class="tsp-box-top">
                                    <span class="tsp-box-icon"><i class="bi bi-tools"></i></span>
                                    <span class="tsp-box-num">04</span>
                                </div>
                                <h3 class="tsp-box-title">Equipment & Spare Parts</h3>
                                <p class="tsp-box-copy">Spray guns, feed systems and genuine spare parts engineered to keep every production line running.</p>
                                <div class="tp-rounded-btn-wrap tp-about-wd-btn tp_fade_anim" data-delay=".5"
                                    data-fade-from="top" data-ease="bounce">

                                    <div class="btn_wrapper d-inline-block">

                                        <a href="#" class="tp-btn-rounded btn-item">



                                            Learn More

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

                            <div class="tsp-box">
                                <div class="tsp-box-top">
                                    <span class="tsp-box-icon"><i class="bi bi-life-preserver"></i></span>
                                    <span class="tsp-box-num">05</span>
                                </div>
                                <h3 class="tsp-box-title">Service</h3>
                                <p class="tsp-box-copy">Application support, operator training and preventive maintenance backed by our engineering team.</p>
                                <div class="tp-rounded-btn-wrap tp-about-wd-btn tp_fade_anim" data-delay=".5"
                                    data-fade-from="top" data-ease="bounce">

                                    <div class="btn_wrapper d-inline-block">

                                        <a href="#" class="tp-btn-rounded btn-item">



                                            Learn More

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

                            <div class="tsp-box c-ink">
                                <div class="tsp-box-top">
                                    <span class="tsp-box-icon"><i class="bi bi-grid-3x3-gap"></i></span>
                                    <span class="tsp-box-num"></span>
                                </div>
                                <h3 class="tsp-box-title">View All Products</h3>
                                <p class="tsp-box-copy">Explore our complete range of welding, thermal spray, additive manufacturing, equipment and specialty products.</p>
                                <div class="tp-rounded-btn-wrap tp-about-wd-btn tp_fade_anim" data-delay=".5"
                                    data-fade-from="top" data-ease="bounce">

                                    <div class="btn_wrapper d-inline-block">

                                        <a href="#" class="tp-btn-rounded btn-item">



                                            Learn More

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
                <!-- tsp-box-grid-end -->

                <!-- tsp-quality-area-start -->
                <div class="tsp-quality-area pb-90 pt-90 tsp-panel">
                    <div class="tsp-quality-bg" data-parallax-bg @if($detail && $detail->knowledge_background_image) data-bg="{{ asset('product/details/knowledge/' . $detail->knowledge_background_image) }}" @endif></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="al-project-seo-title-box">
                                    <span class="cnt-section-subtitle mb-20 tp_fade_anim" data-delay=".3">
                                        {{ $detail?->knowledge_title }}
                                    </span>

                                    <h2 class="tp-section-pp-title fw-400 fs-md-40 fs-xs-30 lh-120-per tp-text-common-white tp_text_invert">
                                        {{ $detail?->knowledge_heading }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">

                                <div class="fs-16 lh-150-per mt-20" style="color: rgba(243,241,242,.65); max-width: 640px;">
                                    {!! $detail?->knowledge_description !!}
                                </div>
                            </div>
                        </div>

                        <div class="tsp-quality-stats">
                            @foreach(($detail?->features ?? collect()) as $feature)
                            <div class="tsp-quality-stat">
                                <div class="tsp-quality-stat-num">{{ $feature->number }}</div>
                                <div class="tsp-quality-stat-label">{{ $feature->description }}</div>
                            </div>
                            @endforeach
                        </div>

                        <div class="tsp-quality-links">
                            @if($detail?->knowledge_certificate)
                            <a href="{{ asset('product/details/certificates/' . $detail->knowledge_certificate) }}" target="_blank" class="tsp-quality-link">
                                <i class="bi bi-award"></i> View Certifications
                            </a>
                            @endif
                            @if($detail?->knowledge_brochure)
                            <a href="{{ asset('product/details/brochures/' . $detail->knowledge_brochure) }}" target="_blank" class="tsp-quality-link">
                                <i class="bi bi-file-earmark-text"></i> Brochures &amp; Catalogue
                            </a>
                            @endif
                            @if($detail?->knowledge_map_url)
                            <a href="{{ $detail->knowledge_map_url }}" target="_blank" class="tsp-quality-link">
                                <i class="bi bi-geo-alt"></i> Manufacturing Locations
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- tsp-quality-area-end -->


                <!-- tsp-industries-area-start -->
                <div class="tsp-industries-area pb-90 pt-90 tsp-panel">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <span class="cnt-section-subtitle mb-20 tp_fade_anim" data-delay=".3">
                                    {{ $detail?->industries_title }}
                                </span>

                                <h2
                                    class="tp-about-2-title fs-md-40 fs-xs-30 tp_text_invert invert-black-3 tp-ff-dm fw-600">
                                    {{ $detail?->industries_heading }}
                                </h2>
                            </div>
                        </div>

                        <div class="tsp-industries-grid">

                            @php $industryIcons = ['bi-gear-wide-connected','bi-lightning-charge','bi-truck','bi-train-front','bi-building','bi-water','bi-diagram-3','bi-cpu']; @endphp
                            @foreach(($detail?->industries ?? collect()) as $industry)
                            <div class="tsp-industry-tile">
                                <span class="tsp-industry-icon"><i class="bi {{ $industryIcons[$loop->index % count($industryIcons)] }}"></i></span>
                                <span class="tsp-industry-name">{{ $industry->name }}</span>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <!-- tsp-industries-area-end -->


                <!-- tsp-video-area-start -->
                <div class="tsp-video-area pb-90 pt-90 tsp-panel">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <span class="cnt-section-subtitle mb-20 tp_fade_anim" data-delay=".3">
                                    {{ $detail?->media_title }}
                                </span>

                                <h2
                                    class="tp-about-2-title fs-md-40 fs-xs-30 tp_text_invert invert-black-3 tp-ff-dm fw-600">
                                    {{ $detail?->media_heading }}
                                </h2>
                                <div class="mt-20">
                                    {!! $detail?->media_description !!}
                                </div>
                            </div>
                            <div class="col-lg-12">

                            </div>
                        </div>

                        <div class="tsp-video-frame mt-50">
                            @if($detail?->media_youtube_url)
                            <iframe width="100%" height="500px" src="{{ $detail->media_youtube_url }}" title="{{ $category->name }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- tsp-video-area-end -->


                <div class="tp-text-slider-area pt-25 pb-25 tp-bg-theme-primary">
                    <div class="swiper-container tp-text-slider-active">
                        <div class="swiper-wrapper slide-transtion">

                            @if($customer && $customer->highlights->count())
                                @foreach($customer->highlights as $hl)
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
                            @endif

                        </div>
                    </div>
                </div>

            </main>

            @include('components.frontend.footer')

        </div>
    </div>

    @include('components.frontend.main-js')

    <script>
        document.querySelectorAll('[data-bg]').forEach(function (el) {
            el.style.backgroundImage = "url('" + el.getAttribute('data-bg') + "')";
        });
    </script>
</body>

</html>