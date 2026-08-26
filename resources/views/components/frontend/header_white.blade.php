@php
    // Header menus driven by the brand categories flagged for each header (oldest first).
    $headerBrandCategories = \App\Models\MainCategory::where('show_in_brand_header', true)
        ->with(['subCategories' => fn ($q) => $q->orderBy('id')])
        ->orderBy('id')->get();

    $headerProductCategories = \App\Models\MainCategory::where('show_in_product_header', true)
        ->orderBy('id')->get();

    // Icons cycled per menu item (categories have no icon field of their own).
    $menuIcons = ['bi-shield-check', 'bi-fire', 'bi-layers', 'bi-tools', 'bi-stars'];
@endphp

    <!-- Preloader -->
    <div class="loader-wrap">
        <svg viewBox="0 0 1000 1000" preserveAspectRatio="none">
            <path id="svg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
        </svg>

        <div class="loader-wrap-heading">
            <div class="load-text">

                <span>W</span>
                <span>E</span>
                <span>L</span>
                <span>D</span>
                <span>W</span>
                <span>E</span>
                <span>L</span>
                <span>L</span>

            </div>
        </div>
    </div>
    <!-- Preloader End -->
    <!-- loading-area-end -->

    <!-- Begin magic cursor -->
    <div id="magic-cursor" class="cursor-black-bg">
        <div id="ball"></div>
    </div>
    <div class="scrollToTop">
        <div class="arrowUp">
            <i class="fa-light fa-arrow-up"></i>
        </div>
        <div class="water">
            <svg viewBox="0 0 560 20" class="water_wave water_wave_back">
                <use xlink:href="#wave"></use>
            </svg>
            <svg viewBox="0 0 560 20" class="water_wave water_wave_front">
                <use xlink:href="#wave"></use>
            </svg>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 560 20" style="display: none;">
                <symbol id="wave">
                    <path
                        d="M420,20c21.5-0.4,38.8-2.5,51.1-4.5c13.4-2.2,26.5-5.2,27.3-5.4C514,6.5,518,4.7,528.5,2.7c7.1-1.3,17.9-2.8,31.5-2.7c0,0,0,0,0,0v20H420z"
                        fill="#"></path>
                    <path
                        d="M420,20c-21.5-0.4-38.8-2.5-51.1-4.5c-13.4-2.2-26.5-5.2-27.3-5.4C326,6.5,322,4.7,311.5,2.7C304.3,1.4,293.6-0.1,280,0c0,0,0,0,0,0v20H420z"
                        fill="#"></path>
                    <path
                        d="M140,20c21.5-0.4,38.8-2.5,51.1-4.5c13.4-2.2,26.5-5.2,27.3-5.4C234,6.5,238,4.7,248.5,2.7c7.1-1.3,17.9-2.8,31.5-2.7c0,0,0,0,0,0v20H140z"
                        fill="#"></path>
                    <path
                        d="M140,20c-21.5-0.4-38.8-2.5-51.1-4.5c-13.4-2.2-26.5-5.2-27.3-5.4C46,6.5,42,4.7,31.5,2.7C24.3,1.4,13.6-0.1,0,0c0,0,0,0,0,0l0,20H140z"
                        fill="#"></path>
                </symbol>
            </svg>
        </div>
    </div>
    <!-- backtotop area end -->

    <!-- tp-offcanvus-area-start -->
    <div class="tp-offcanvas-area">
        <div class="tp-offcanvas">

            <div class="tp-offcanvas-top d-flex align-items-center justify-content-between">
                <div class="tp-offcanvas-close-btn">
                    <button class="close-btn">
                        <svg width="37" height="38" viewBox="0 0 37 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.19141 9.80762L27.5762 28.1924" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.19141 28.1924L27.5762 9.80761" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Offcanvas Content -->
            <div class="tp-offcanvas-content d-none d-xl-block">
                <h3 class="tp-offcanvas-title">Weldwell Speciality Pvt. Ltd.</h3>
                <p>
                    Your trusted partner for premium welding consumables, welding equipment,
                    thermal spray products and industrial engineering solutions. Delivering
                    quality and innovation through globally recognized brands.
                </p>
            </div>

            <!-- Mobile Menu -->
            <div class="tp-offcanvas-menu d-xl-none">
                <nav></nav>
            </div>


            <!-- Contact -->
            <div class="tp-offcanvas-contact">
                <h3 class="tp-offcanvas-title sm">Contact Information</h3>
                <ul>
                    <li>
                        <a href="tel:+912224109500">+91 22 2410 9500</a>
                    </li>
                    <li>
                        <a href="mailto:info@weldwell.com">info@weldwell.com</a>
                    </li>
                    <li>
                        <a href="https://weldwell.com/" target="_blank">
                            www.weldwell.com
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Social -->
            <div class="tp-offcanvas-social">
                <h3 class="tp-offcanvas-title sm">Follow Us</h3>
                <ul>
                    <li>
                        <a href="https://www.linkedin.com/" target="_blank">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>

                    <li>
                        <a href="https://www.facebook.com/" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>

                    <li>
                        <a href="https://www.instagram.com/" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>

                    <li>
                        <a href="https://www.youtube.com/" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <div class="body-overlay"></div>
    <!-- tp-offcanvus-area-end -->



<header>

      <!-- tp-header-area-start -->
      <div id="header-sticky" class="tp-header-area pre-header sticky-white-bg tp-header-blur header-transparent tp-header-lg-spacing">
         <div class="container-fluid container-1800">
            <div class="row align-items-center">
               <div class="col-xl-2 col-6">
                  <div class="tp-header-logo">
                     <a href="{{ route('frontend.index') }}"><img data-width="240" src="{{ asset('frontend/assets/images/logo.jpg') }}" alt="logo"></a>
                  </div>
               </div>
               <div class="col-xl-7 d-none d-xl-block">
                  <div class="tp-main-menu tp-header-dropdown dropdown-white-bg d-flex justify-content-center">
                     <nav class="tp-mobile-menu-active">
                                    <ul>




                                        <li class="has-dropdown">
                                            <a href="{{ route('frontend.index') }}">Home
                                            </a>
                                        </li>
                                        <li class="has-dropdown">
                                            <a href="{{ route('frontend.about_us') }}">About Us
                                            </a>
                                        </li>
                                        <li class="has-dropdown p-inherit">
                                            <a href="#">Brands
                                                <span>
                                                    <svg width="7" height="6" viewBox="0 0 7 6" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M2.7 4.93333L0.2 1.6C-0.294427 0.940764 0.175955 0 1 0H6C6.82405 0 7.29443 0.940764 6.8 1.6L4.3 4.93333C3.9 5.46667 3.1 5.46667 2.7 4.93333Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </a>
                                            <div class="tp-megamenu-wrapper mega-menu megamenu-white-bg">
                                                <div class="row gx-0">
                                                    <div class="col-xl-12">
                                                        <div class="row gx-0">
                                                            <div class="col-xl-3">
                                                                <div class="tp-megamenu-list">
                                                                    <h4 class="tp-megamenu-title">
                                                                        <i class="bi bi-gear-wide-connected me-2"></i>
                                                                        Welding Consumables
                                                                    </h4>
                                                                    <ul>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/special-metals.webp') }}"
                                                                                    alt="Special Metals Welding Products logo"
                                                                                    class="tp-megamenu-brand-logo">Special
                                                                                Metals Welding Products, USA</a></li>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/kobelco.webp') }}"
                                                                                    alt="Kobelco Welding logo"
                                                                                    class="tp-megamenu-brand-logo">Kobelco
                                                                                Welding (Kobe Steel Ltd., Japan)</a></li>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/taseto.webp') }}"
                                                                                    alt="Taseto logo"
                                                                                    class="tp-megamenu-brand-logo">Taseto,
                                                                                Japan</a></li>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/ampco-metal.webp') }}"
                                                                                    alt="Ampco Metal logo"
                                                                                    class="tp-megamenu-brand-logo">Ampco
                                                                                Metal, USA</a></li>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/exaton.webp') }}"
                                                                                    alt="EXATON logo"
                                                                                    class="tp-megamenu-brand-logo">EXATON
                                                                                (formerly Sandvik, Sweden)</a></li>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/ia-barnes.webp') }}"
                                                                                    alt="I.A. Barnes & Company logo"
                                                                                    class="tp-megamenu-brand-logo">I.A.
                                                                                Barnes &amp; Company, UK</a></li>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/alunox.webp') }}"
                                                                                    alt="Alunox logo"
                                                                                    class="tp-megamenu-brand-logo">Alunox,
                                                                                Germany</a></li>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/beijing-metals.webp') }}"
                                                                                    alt="Beijing Metals logo"
                                                                                    class="tp-megamenu-brand-logo">Beijing
                                                                                Metals, China</a></li>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/safra.webp') }}"
                                                                                    alt="Safra logo"
                                                                                    class="tp-megamenu-brand-logo">Safra</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-3">
                                                                <div class="tp-megamenu-list">
                                                                    <h4 class="tp-megamenu-title">
                                                                        <i class="bi bi-tools me-2"></i>
                                                                        Equipment &amp; Accessories
                                                                    </h4>
                                                                    <ul>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/kemppi.webp') }}"
                                                                                    alt="Kemppi logo"
                                                                                    class="tp-megamenu-brand-logo">Kemppi,
                                                                                Finland</a></li>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/panasonic.webp') }}"
                                                                                    alt="Panasonic logo"
                                                                                    class="tp-megamenu-brand-logo">Panasonic,
                                                                                Japan</a></li>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/hypertherm.webp') }}"
                                                                                    alt="Hypertherm logo"
                                                                                    class="tp-megamenu-brand-logo">Hypertherm,
                                                                                USA</a></li>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/huntingdon-fusion.webp') }}"
                                                                                    alt="Huntingdon Fusion Techniques logo"
                                                                                    class="tp-megamenu-brand-logo">Huntingdon
                                                                                Fusion Techniques, UK</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-3">
                                                                <div class="tp-megamenu-list">
                                                                    <h4 class="tp-megamenu-title">
                                                                        <i class="bi bi-fire me-2"></i>
                                                                        Thermal Spray Products
                                                                    </h4>
                                                                    <ul>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/sentesbir.webp') }}"
                                                                                    alt="SentesBir logo"
                                                                                    class="tp-megamenu-brand-logo">SentesBir,
                                                                                Turkey</a></li>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/powder-alloys.webp') }}"
                                                                                    alt="Powder Alloys Corporation logo"
                                                                                    class="tp-megamenu-brand-logo">Powder
                                                                                Alloys Corporation, USA</a></li>
                                                                        <li><a href="#"><img
                                                                                    src="{{ asset('frontend/assets/images/brands/technogenia.webp') }}"
                                                                                    alt="Technogenia logo"
                                                                                    class="tp-megamenu-brand-logo">Technogenia</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3">
                                                                <div class="tp-megamenu-list">
                                                                    <div class="tp-megamenu-thumb">
                                                                        <img src="{{ asset('frontend/assets/images/about/4790.webp') }}" alt="">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </li>
                                        <li class="has-dropdown">
                                            <a href="#">Product
                                                <span>
                                                    <svg width="7" height="6" viewBox="0 0 7 6" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M2.7 4.93333L0.2 1.6C-0.294427 0.940764 0.175955 0 1 0H6C6.82405 0 7.29443 0.940764 6.8 1.6L4.3 4.93333C3.9 5.46667 3.1 5.46667 2.7 4.93333Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </a>
                                            <ul class="tp-submenu submenu">
                                                @foreach(($headerProductCategories ?? collect()) as $pcat)
                                                <li>
                                                    <a href="#">
                                                        <i class="bi {{ $menuIcons[$loop->index % count($menuIcons)] }} me-2"></i>
                                                        {{ $pcat->name }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="has-dropdown">
                                            <a href="#">Media / Blogs
                                                <span>
                                                    <svg width="7" height="6" viewBox="0 0 7 6" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M2.7 4.93333L0.2 1.6C-0.294427 0.940764 0.175955 0 1 0H6C6.82405 0 7.29443 0.940764 6.8 1.6L4.3 4.93333C3.9 5.46667 3.1 5.46667 2.7 4.93333Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </a>
                                            <ul class="tp-submenu submenu">
                                                <li>
                                                    <a href="#">
                                                        <i class="bi bi-journal-richtext me-2"></i>
                                                        Magazine
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="bi bi-pencil-square me-2"></i>
                                                        Blog
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="has-dropdown">
                                            <a href="#">Careers
                                            </a>
                                        </li>
                                    </ul>
                     </nav>
                  </div>
               </div>
               <div class="col-xl-3 col-6">
                          <div class="tp-header-right d-flex align-items-center justify-content-end">
                                <div class="tp-header-btn tp-header-btn-spacing d-none d-md-inline-block ml-20">
                                    <a href="#"
                                        class="tp-btn-lg d-inline-block lh-0 tp-round-4 fs-15 tp-bg-common-black text-uppercase ls-0 tp-btn-switch-animation tp-text-common-white hover-text-white tp-ff-heading fw-500">
                                        <span class="d-flex align-items-center justify-content-center">
                                            <span class="btn-text">Let’s Talk</span>
                                            <span class="btn-icon">
                                                <svg width="25" height="10" viewBox="0 0 25 10" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            <span class="btn-icon">
                                                <svg width="25" height="10" viewBox="0 0 25 10" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </span>
                                    </a>
                                </div>
                                <button
                                    class="tp-menu-bar tp-header-sidebar-btn tp-header-2-menu-btn tp-header-ai-menu-btn ml-20">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
               </div>
            </div>
         </div>
      </div>
      <!-- tp-header-area-end -->

   </header>
