<!doctype html>
<html class="no-js" lang="en">

<head>
    @include('components.frontend.head')
    <style>
        /* Draw the red check-circle for dynamic (CKEditor) lists that have no inline <span><svg>. */
        .cst-about-list.cst-about-list-dynamic ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .cst-about-list.cst-about-list-dynamic ul li {
            display: block;
            position: relative;
            padding-left: 45px;
            margin-bottom: 20px;
        }
        .cst-about-list.cst-about-list-dynamic ul li::before {
            content: "";
            position: absolute;
            left: 0;
            top: 1px;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: var(--tp-theme-primary);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='10' viewBox='0 0 12 10' fill='none'%3E%3Cpath d='M0.75 6.05455L3.22545 8.53L10.6518 0.75' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 12px 10px;
        }

       
    </style>
</head>

<body class="tp-magic-cursor loaded">
    @include('components.frontend.header_white')


    <div id="smooth-wrapper">
        <div id="smooth-content">
            <main>




                <div class="cst-about-ptb p-relative pt-170 pb-40">
                    <div class="container container-1524">
                        <div class="row align-items-center">

                            <!-- Image -->
                            <div class="col-xxl-4 col-lg-6">
                                <div class="cst-about-thumb fix">
                                    <div class="tp_img_reveal">
                                        <img src="{{ $intro && $intro->image ? asset('about/intro/'.$intro->image) : 'assets/images/about/42273.webp' }}"
                                            alt="Weldwell Speciality Pvt. Ltd. - Industrial Welding Solutions">
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="col-xxl-8 col-lg-6 d-flex align-items-center">
                                <div class="cst-about-right w-100">

                                    <div class="cst-about-heading mb-40">

                                        <h3 class="cst-section-title fs-32 mb-25 tp_fade_anim"
                                            data-delay=".3">
                                            @if($intro && $intro->heading)
                                            {{ $intro->heading }}
                                            @endif
                                        </h3>

                                        <div class="cst-about-text tp_fade_anim" data-delay=".5">

                                            @if($intro && $intro->introduction)
                                            {!! $intro->introduction !!}
                                            @endif

                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- about area end -->


                <!-- feature area start -->

                <div class="cst-feature-ptb pb-120">
                    <div class="container container-1524">
                        <div class="cst-feature-top">
                            <div class="row">

                                @php $vIcons = ['fa-eye', 'fa-bullseye', 'fa-handshake', 'fa-star', 'fa-award', 'fa-gem']; @endphp
                                @forelse(optional($intro)->visions ?? [] as $vision)
                                <div class="col-lg-4 col-md-6">
                                    <div class="cst-feature-item mb-30 tp_fade_anim" data-delay=".{{ 3 + ($loop->index * 2) }}">
                                        <div class="cst-feature-item-icon">
                                            <span>
                                                <i class="fa-solid {{ $vIcons[$loop->index % count($vIcons)] }}"></i>
                                            </span>
                                        </div>
                                        <div class="cst-feature-item-content">
                                            <h5 class="cst-feature-item-title">{{ $vision->heading }}</h5>
                                            <div class="color-g mb-0">{!! $vision->description !!}</div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <!-- Vision -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="cst-feature-item mb-30 tp_fade_anim" data-delay=".3">
                                        <div class="cst-feature-item-icon">
                                            <span>
                                                <i class="fa-solid fa-eye"></i>
                                            </span>
                                        </div>
                                        <div class="cst-feature-item-content">
                                            <h5 class="cst-feature-item-title">Our Vision</h5>
                                            <p class="color-g mb-0">
                                                To be the most sought-after trusted source of welding
                                                solutions and a forerunner in supporting services
                                                to the welding community.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endforelse

                            </div>
                        </div>

                        <div class="cst-feature-bottom pt-40">
                            <div class="row justify-content-center">
                                <div class="col-lg-9">
                                    <h4 class="cst-feature-text text-center tp_fade_anim" data-delay=".9">
                                        <span>{{ $intro && $intro->motto_heading ? $intro->motto_heading : 'Building Stronger Connections' }}</span>
                                        @if($intro && $intro->motto_description)
                                        {{-- Rich field: strip the block <p> wrapper so it stays inline in the heading, keep inline tags. --}}
                                        {!! strip_tags($intro->motto_description, '<a><br><strong><b><em><i><u><span>') !!}
                                                                    @endif
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tp-video-area-start -->

                <!-- tp-cta-area-start -->
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
                                        {{ $connection && $connection->title ? $connection->title : 'Trusted Welding Solutions Since 1971' }}
                                    </span>

                                    <h2
                                        class="tp-footer-top-title tp-text-common-white text-uppercase fw-600 mb-40 rotate-text-anim">
                                        @if($connection && $connection->heading)
                                        {!! strip_tags($connection->heading, '<br><b><strong><i><em><u><a><span>') !!}
                                                                    @else
                                                                    Let's Build Stronger<br /> Connections
                                                                    @endif
                                    </h2>

                                    @php $ctaEmail = $connection && $connection->email ? $connection->email : 'info@weldwell.com'; @endphp
                                    <div class="tp_fade_anim" data-delay=".5">
                                        <a class="tp-cta-wd-email d-inline-block fs-35 fs-xs-25 fw-600 tp-text-common-white"
                                            href="mailto:{{ $ctaEmail }}">
                                            {{ $ctaEmail }}
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tp-cta-area-end -->

                <!-- tp-about-area-start -->
                <div id="about" class="tp-about-area pt-150 pb-100">
                    <div class="container container-1524">
                        <div class="row">
                            <div class="col-lg-12">
                                @php
                                    // Support both new plain-text headings and legacy CKEditor HTML:
                                    // turn <br> and closing block tags into line breaks, drop remaining tags, escape.
                                    $qHeading = null;
                                    if ($quality && $quality->heading) {
                                        $raw = str_ireplace(['<br>', '<br/>', '<br />', '</p>', '</div>', '</h1>', '</h2>', '</h3>', '</h4>', '</h5>', '</h6>'], "\n", $quality->heading);
                                        $qHeading = nl2br(e(trim(html_entity_decode(strip_tags($raw), ENT_QUOTES))));
                                    }
                                @endphp
                                        <div class="tp-about-cst-title-wrap mb-80">
                                            <h2 class="tp-about-2-title fs-md-40 fs-xs-30 tp_text_invert invert-black-3 tp-ff-dm fw-600 tp-text-common-black-1">@if($qHeading){!! $qHeading !!}@else What Sets Us Apart<br>
                                                Three Decades of Welding Expertise, <br>
                                                Trusted Partnerships & Knowledge Sharing.@endif</h2>
                                        </div>
                            </div>
                            <div class="col-xl-9 col-lg-7">
                                <div class="tp-about-cst-tab-wrap ml-35 mb-30">
                                    @if($quality && $quality->values->count())
                                    <div class="tp-about-cst-tab mb-25">
                                        <ul role="tablist">
                                            @foreach($quality->values as $val)
                                            <li class="nav-tab-item" role="presentation">
                                                <a href="#qtab-{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab">{{ $val->value_name }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="tab-content p-relative mb-45">
                                        @foreach($quality->values as $val)
                                        <div class="tab-pane {{ $loop->first ? 'active show' : '' }}" id="qtab-{{ $loop->index }}" role="tabpanel">
                                            <div class="tp-about-cst-tab-content">
                                                <div class="cst-about-list cst-about-list-dynamic d-block mt-50 tp_fade_anim" data-delay=".7">
                                                    {!! $val->description !!}
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <div class="tp-about-cst-tab mb-25">
                                        <ul role="tablist">
                                            <li class="nav-tab-item" role="presentation">
                                                <a href="#groth" class="active" data-bs-toggle="tab">Core Strengths
                                                </a>
                                            </li>
                                            <li class="nav-tab-item" role="presentation">
                                                <a href="#market" data-bs-toggle="tab">Channel Partners
                                                </a>
                                            </li>
                                            <li class="nav-tab-item" role="presentation">
                                                <a href="#sharing" data-bs-toggle="tab">Knowledge Sharing

                                                </a>
                                            </li>
                                            <li class="nav-tab-item" role="presentation">
                                                <a href="#portfolio" data-bs-toggle="tab">Product Portfolio</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content p-relative mb-45">
                                        <div class="tab-pane active show" id="groth" role="tabpanel">
                                            <div class="tp-about-cst-tab-content">
                                                <div class="cst-about-list d-block mt-50 tp_fade_anim" data-delay=".7">
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Strong product knowledge with over three decades of experience


                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Value addition through technical support to offer right product


                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Access to Hi-tech Premium Products from Global Sources


                                                        </li>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Well-equipped Technology Centre to service customer needs

                                                        </li>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Persistent Commitment to Customer satisfaction.

                                                        </li>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Professional Management - Impeccable work ethics


                                                        </li>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Large Warehouse – Quick Response and Optimum Quantity Delivery



                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="market" role="tabpanel">
                                            <div class="tp-about-cst-tab-content">
                                                <div class="cst-about-list d-block mt-50 tp_fade_anim" data-delay=".7">
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Special metals Welding Product Company, USA



                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Sentes Bir – Turkey



                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Kobe Steel Ltd. – Welding Company, Japan



                                                        </li>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Ampco Metals – USA

                                                        </li>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Taseto Co. – Japan*


                                                        </li>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Exaton – ESAB



                                                        </li>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            I.A. Barnes and Co. Ltd. U.K.




                                                        </li>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Hypertherm (S) Pvt. Ltd. U.S.A.
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Kemppi Oy, India

                                                        </li>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Powder Alloys Corporation (PAC) – U.S.A.

                                                        </li>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Panasonic Welding Systems, Japan

                                                        </li>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Nova Metals

                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="sharing" role="tabpanel">
                                            <div class="tp-about-cst-tab-content">
                                                <div class="cst-about-list d-block mt-50 tp_fade_anim" data-delay=".7">
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Our team provides technical guidance to complex welding problems Assist with Reliable Source – Right Process and Right Product




                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Knowledge sharing through a quarterly technical magazine “Spectrum” distributed to over welding professionals across the country and uploaded at www.weldwell.com.




                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Access to library of technical books and specifications




                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="portfolio" role="tabpanel">
                                            <div class="tp-about-cst-tab-content">
                                                <div class="cst-about-list d-block mt-50 tp_fade_anim" data-delay=".7">
                                                    <ul>

                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10"
                                                                    viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75"
                                                                        stroke="#141B34" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Complete range of Arc Welding Consumables for all Conventional Processes
                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10"
                                                                    viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75"
                                                                        stroke="#141B34" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Thermal Spray Powders for PTA, HVOF, Laser and Plasma Spray Processes
                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10"
                                                                    viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75"
                                                                        stroke="#141B34" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Welding Equipment for GMAW, GTAW, SMAW and Hybrid Processes
                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10"
                                                                    viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75"
                                                                        stroke="#141B34" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Air Plasma Cutting Equipment
                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10"
                                                                    viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75"
                                                                        stroke="#141B34" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Powders for Metal Additive Manufacturing
                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10"
                                                                    viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75"
                                                                        stroke="#141B34" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Special Customised Products for Specific Applications
                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10"
                                                                    viewBox="0 0 12 10" fill="none">
                                                                    <path d="M0.75 6.05455L3.22545 8.53L10.6518 0.75"
                                                                        stroke="#141B34" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            Repairs, Maintenance, Accessories and Spare Parts
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="tp-about-cst-list-wrap p-relative mb-30">
                                    <div class="tp-about-cst-list-thumb text-end fix tp-round-26">
                                        <img data-speed="0.9" class="tp-round-20" src="{{ $quality && $quality->image ? asset('about/qualities/'.$quality->image) : asset('frontend/assets/images/about/64797.webp') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tp-about-area-end -->

                <!-- tp-video-area-start -->
                <div class="tp-video-area tp-video-spacing scale-up-img p-relative z-index-1 fix">
                    <div class="tp-video-thumb">
                        <img data-speed="0.4" class="img-cover scale-up" src="{{ $quality && $quality->background_image ? asset('about/qualities/'.$quality->background_image) : 'assets/images/about/2151349678.webp' }}" alt="Weldwell Speciality Pvt. Ltd. facility">
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-xxl-4 col-xl-5 col-lg-6">
                                <div class="tp-video-content tp-bg-common-black">
                                    <h4 class="tp-text-common-white fw-500 fs-25 fs-xs-20 lh-36 mb-50">
                                        @if($quality && $quality->more_info_desc){!! nl2br(e(html_entity_decode(strip_tags(str_ireplace(['<br>', '<br/>', '<br />', '</p>', '</div>', '</h1>', '</h2>', '</h3>', '</h4>', '</h5>', '</h6>'], "\n", $quality->more_info_desc)), ENT_QUOTES))) !!}@else A one-stop source across welding consumables, thermal spray powders, and cutting & welding equipment — backed by a technically qualified team committed to your fabrication success.@endif
                                    </h4>
                                    <span class="tp-hero-bottom-border mb-40">
                                        <svg height="6" viewBox="0 0 344 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5 2.5L0 0.113249V5.88675L5 3.5V2.5ZM339 3.5L344 5.88675V0.113249L339 2.5V3.5ZM4.5 3.5H339.5V2.5H4.5V3.5Z" fill="white" fill-opacity="0.15" />
                                        </svg>
                                    </span>
                                    <div class="tp-video-main tp-hero-video d-flex align-items-center">
                                        <a class="tp-hero-video-btn popup-video mr-20" href="{{ $quality && $quality->youtube_link ? $quality->youtube_link : 'https://www.youtube.com/watch?v=go7QYaQR494' }}">
                                            <span>
                                            </span>
                                        </a>
                                        <p class="tp-ff-heading lh-110-per mb-0 fw-700 fs-18 tp-text-common-white">
                                            @if($quality && $quality->statement){{ $quality->statement }}@else Serving 600+ customers<br>across India since 1992.@endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tp-video-area-end -->

                <!-- Product Area Start -->
                <!-- Product Area End -->
                <section class="customers-served-section">
                    <div class="container">

                        <div class="row g-4">
                            <div class="tp-portfolio-sa-title-wrap mb-40 text-center">

                                <span class="cnt-section-subtitle mb-20 tp_fade_anim" data-delay=".3">
                                    {{ $customer && $customer->title ? $customer->title : 'Customers Served' }}
                                </span>

                                <h2 class="tp-about-2-title fs-md-40 fs-xs-30 tp_text_invert invert-black-3 tp-ff-dm fw-600">
                                    {{ $customer && $customer->heading ? $customer->heading : 'Serving Customers with Excellence' }}
                                </h2>




                            </div>

                            @if($customer && $customer->features->count())
                                @php $fIcons = ['bi-lightning-charge','bi-fuel-pump','bi-building-gear','bi-gear-wide-connected','bi-droplet','bi-boxes','bi-grid-3x3-gap','bi-patch-check']; @endphp
                                @foreach($customer->features as $feature)
                                <div class="col-lg-3 col-md-6">
                                    <div class="industry-card">
                                        <span class="industry-line"></span>
                                        <div class="industry-icon">
                                            <i class="bi {{ $fIcons[$loop->index % count($fIcons)] }}"></i>
                                        </div>
                                        <div class="industry-content">
                                            <h3>{{ $feature->feature_name }}</h3>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif


                        </div>

                    </div>
                </section>
                <!-- tp-video-area-end -->

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

</body>

</html>