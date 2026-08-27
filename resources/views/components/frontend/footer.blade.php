@php
    // Footer "Our Products" list — product categories (oldest first).
    $footerProductCategories = \App\Models\ProductCategory::where('is_active', true)
        ->with('activeDetail')->orderBy('id')->get();
@endphp

  <footer>
                <!-- tp-footer area start -->
                <div class="tp-footer-area tp-bg-common-black pt-60 tp-techonolgy-capsule-wrapper tp-footer-pb-capsule-wrapper"
                    data-tp-throwable-scene="true">
                    <div class="tp-footer-wd-main">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                    <div class="tp-footer-widget tp-footer-pb-widget mb-45 tp_fade_anim"
                                        data-delay=".3">
                                        <div class="tp-footer-logo mb-35">
                                            <a href="{{ route('frontend.index') }}">
                                                <img data-width="250" src="{{ asset('frontend/assets/images/logo1.webp') }}"
                                                    alt="Weldwell Speciality Pvt. Ltd.">
                                            </a>
                                        </div>

                                        <p class="tp-text-grey-5 fs-16 tp-ff-inter lh-150-per mb-25">
                                            Delivering premium welding consumables, thermal spray products,
                                            additive manufacturing materials and industrial welding equipment
                                            with trusted global brands since 1991.
                                        </p>

                                        <div class="tp-footer-wd-social d-flex">
                                            <div><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></div>
                                            <div><a href="#"><i class="fa-brands fa-facebook-f"></i></a></div>
                                            <div><a href="#"><i class="fa-brands fa-instagram"></i></a></div>
                                            <div><a href="#"><i class="fa-brands fa-youtube"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <div class="tp-footer-it-widget tp-footer-pb-widget mb-40 ml-20 tp_fade_anim"
                                        data-delay=".5">

                                        <h3
                                            class="tp-footer-widget-title tp-ff-inter fs-24 fw-600 mb-30 tp-text-common-white">
                                            Contact Us
                                        </h3>

                                        <a class="tp-text-grey-5 opacity-8 tp-ff-inter fs-16 lh-140-per d-block mb-25"
                                            href="https://maps.google.com" target="_blank">

                                            401, Vikas Commercial Centre,<br>
                                            Dr. C. Gidwani Road,<br>
                                            Chembur, Mumbai - 400074
                                        </a>

                                        <a class="tp-ff-inter fw-600 fs-16 tp-text-grey-5 d-block mb-20"
                                            href="tel:+912266462000">
                                            +91 22 6646 2000
                                        </a>

                                        <a class="tp-ff-inter fs-16 tp-text-grey-5" href="mailto:sales@weldwell.com">
                                            sales@weldwell.com
                                        </a>

                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-6 col-md-6 col-sm-6">
                                    <div class="tp-footer-wd-widget tp-footer-cst-widget tp-footer-it-widget tp-footer-pb-widget mb-40 ml-85 tp_fade_anim"
                                        data-delay=".7">

                                        <h3
                                            class="tp-footer-widget-title tp-ff-inter fs-24 fw-600 mb-30 tp-text-common-white">
                                            Quick Links
                                        </h3>

                                        <ul>
                                            <li><a href="{{ route('frontend.index') }}">Home</a></li>
                                            <li><a href="{{ route('frontend.about_us') }}">About Us</a></li>
                                            <li><a href="#">Products</a></li>
                                            <li><a href="#">Brands</a></li>
                                            <li><a href="#">Contact Us</a></li>
                                        </ul>

                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <div class="tp-footer-wd-widget tp-footer-cst-widget tp-footer-it-widget tp-footer-pb-widget ml-180 mb-40 tp_fade_anim"
                                        data-delay=".9">

                                        <h3
                                            class="tp-footer-widget-title tp-ff-inter fs-24 fw-600 mb-30 tp-text-common-white">
                                            Our Products
                                        </h3>

                                        <ul>
                                            @foreach($footerProductCategories as $pcat)
                                            <li><a href="{{ $pcat->activeDetail ? route('frontend.product_category_details', $pcat->slug) : '#' }}">{{ $pcat->name }}</a></li>
                                            @endforeach
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tp-footer-pb-bottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="tp-footer-copyright text-center">
                                        <p class="tp-text-grey-5  tp-ff-inter">
                                            <span>
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.875 7C0.875 8.62445 1.52031 10.1824 2.66897 11.331C3.81763 12.4797 5.37555 13.125 7 13.125C8.62445 13.125 10.1824 12.4797 11.331 11.331C12.4797 10.1824 13.125 8.62445 13.125 7C13.125 5.37555 12.4797 3.81763 11.331 2.66897C10.1824 1.52031 8.62445 0.875 7 0.875C5.37555 0.875 3.81763 1.52031 2.66897 2.66897C1.52031 3.81763 0.875 5.37555 0.875 7ZM14 7C14 8.85652 13.2625 10.637 11.9497 11.9497C10.637 13.2625 8.85652 14 7 14C5.14348 14 3.36301 13.2625 2.05025 11.9497C0.737498 10.637 0 8.85652 0 7C0 5.14348 0.737498 3.36301 2.05025 2.05025C3.36301 0.737498 5.14348 0 7 0C8.85652 0 10.637 0.737498 11.9497 2.05025C13.2625 3.36301 14 5.14348 14 7ZM7.12775 4.368C6.06725 4.368 5.44162 5.173 5.44162 6.55725V7.48475C5.44162 8.85938 6.05675 9.639 7.12775 9.639C7.98438 9.639 8.56363 9.12625 8.64062 8.39825H9.77375V8.47962C9.68625 9.74662 8.589 10.6383 7.1225 10.6383C5.29288 10.6383 4.26213 9.46925 4.26213 7.48563V6.54675C4.26213 4.56838 5.313 3.3635 7.12337 3.3635C8.59425 3.3635 9.6915 4.28575 9.77375 5.614V5.691H8.64062C8.56363 4.92188 7.96863 4.368 7.12775 4.368Z"
                                                        fill="#F3F1F2" />
                                                </svg>
                                            </span>
                                            2026 Weldwell Speciality Pvt. Ltd. All Rights Reserved. Designed & Developed
                                            by <a href="#"> Matrix Bricks .</a>


                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tp-techonolgy-capsule-item-wrapper tp-footer-pb-shape-wrapper ">
                        <p data-tp-throwable-el="">
                            <span class="tp-techonolgy-capsule-item">
                                <svg width="213" height="421" viewBox="0 0 213 421" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M212.563 0C184.668 -3.29502e-07 157.047 5.44243 131.275 16.0165C105.504 26.5907 82.0876 42.0894 62.3631 61.6278C42.6387 81.1662 26.9923 104.362 16.3175 129.89C5.64269 155.418 0.148437 182.779 0.148438 210.41C0.148438 238.042 5.6427 265.403 16.3175 290.931C26.9923 316.459 42.6387 339.655 62.3631 359.193C82.0876 378.731 105.504 394.23 131.275 404.804C157.047 415.378 184.668 420.821 212.563 420.821L212.563 0Z"
                                        fill="#171718" />
                                </svg>
                            </span>
                        </p>
                        <p data-tp-throwable-el="">
                            <span class="tp-techonolgy-capsule-item">
                                <svg width="353" height="385" viewBox="0 0 353 385" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M110.531 -40.0004C84.729 -23.9733 62.3036 -3.07363 44.5353 21.5054C26.7671 46.0844 14.004 73.8614 6.97473 103.25C-0.0545245 132.639 -1.21227 163.065 3.5676 192.79C8.34746 222.515 18.9713 250.957 34.8326 276.492C50.6939 302.027 71.482 324.155 96.01 341.614C120.538 359.072 148.326 371.518 177.786 378.241C207.247 384.964 237.803 385.833 267.711 380.798C297.619 375.763 326.293 364.922 352.095 348.895L110.531 -40.0004Z"
                                        fill="#171718" />
                                </svg>
                            </span>
                        </p>
                        <p data-tp-throwable-el="">
                            <span class="tp-techonolgy-capsule-item">
                                <svg width="227" height="226" viewBox="0 0 227 226" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="113.22" cy="112.86" r="113.099" fill="#171718" />
                                </svg>
                            </span>
                        </p>
                        <p data-tp-throwable-el="">
                            <span class="tp-techonolgy-capsule-item">
                                <svg width="409" height="408" viewBox="0 0 409 408" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="204.238" cy="203.936" r="203.898" fill="#171718" />
                                </svg>
                            </span>
                        </p>
                        <p data-tp-throwable-el="">
                            <span class="tp-techonolgy-capsule-item">
                                <svg width="213" height="421" viewBox="0 0 213 421" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M212.563 0C184.668 -3.29502e-07 157.047 5.44243 131.275 16.0165C105.504 26.5907 82.0876 42.0894 62.3631 61.6278C42.6387 81.1662 26.9923 104.362 16.3175 129.89C5.64269 155.418 0.148437 182.779 0.148438 210.41C0.148438 238.042 5.6427 265.403 16.3175 290.931C26.9923 316.459 42.6387 339.655 62.3631 359.193C82.0876 378.731 105.504 394.23 131.275 404.804C157.047 415.378 184.668 420.821 212.563 420.821L212.563 0Z"
                                        fill="#171718" />
                                </svg>
                            </span>
                        </p>
                        <p data-tp-throwable-el="">
                            <span class="tp-techonolgy-capsule-item">
                                <svg width="227" height="226" viewBox="0 0 227 226" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="113.138" cy="112.859" r="113.099" fill="#171718" />
                                </svg>
                            </span>
                        </p>
                        <p data-tp-throwable-el="">
                            <span class="tp-techonolgy-capsule-item">
                                <svg width="409" height="408" viewBox="0 0 409 408" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="204.238" cy="203.936" r="203.898" fill="#171718" />
                                </svg>
                            </span>
                        </p>
                    </div>
                </div>
                <!-- tp-footer area end -->
            </footer>