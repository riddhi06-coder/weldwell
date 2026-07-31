<!-- Page Body Start-->
 <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper" data-layout="stroke-svg">
          <div class="logo-wrapper"><a href="{{ route('admin.dashboard') }}" style="display: inline-block; background-color: #e5011c; padding: 10px 16px; border-radius: 8px; line-height: 0; margin-left: 5px; box-shadow: 0 6px 16px rgba(229, 1, 28, 0.22);"><img class="img-fluid" src="{{ asset('/admin/assets/images/logo/logo.webp') }}" alt="" style="width: 130px; max-width: 100% !important;"></a>
		  	<a href="{{ route('admin.dashboard') }}">
				<!-- <img class="img-fluid" src="{{ asset('admin/assets/images/logo/logo-icon.png') }}" alt="" style="max-width: 65% !important;"> -->
			</a>  
		  <div class="back-btn mt-5"><i class="fa fa-angle-left"> </i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
          </div>
          <div class="logo-icon-wrapper text-center"><a href="{{ route('admin.dashboard') }}"><img class="img-fluid" src="{{ asset('admin/assets/images/logo/favicon.png') }}" alt="" style="width: 34px; height: auto;"></a></div>
          <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
              <ul class="sidebar-links" id="simple-bar">

              
                <li class="back-btn"><a href="{{ route('admin.dashboard') }}"><img class="img-fluid" src="{{ asset('admin/assets/images/logo/favicon.png') }}" alt="" style="max-width: 40% !important; margin-right:15px;"></a>
                  <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                </li>


                <li class="sidebar-list mt-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"> </i>
                  <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.dashboard') }}">
                    <svg class="stroke-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#fill-home') }}"></use>
                    </svg>
                    <span class="lan-3">Dashboard</span>
                  </a>
                </li>


                @php $u = auth()->user(); @endphp

                @if($u && ($u->hasPermission('users.view') || $u->hasPermission('roles.view') || $u->hasPermission('permissions.view')))
                <li class="sidebar-list {{ request()->routeIs('admin.users.*', 'admin.roles.*', 'admin.permissions.*') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"></i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-user') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#fill-user') }}"></use>
                    </svg>
                    <span>User Management</span>
                  </a>
                  <ul class="sidebar-submenu">
                      @if($u->hasPermission('users.view'))
                          <li><a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">Users</a></li>
                      @endif
                      @if($u->hasPermission('roles.view'))
                          <li><a href="{{ route('admin.roles.index') }}" class="{{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">Roles</a></li>
                      @endif
                      @if($u->hasPermission('permissions.view'))
                          <li><a href="{{ route('admin.permissions.index') }}" class="{{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">Permissions</a></li>
                      @endif
                  </ul>
                </li>
                @endif

                @if($u && ($u->hasPermission('brand-categories.view') || $u->hasPermission('brand-subcategories.view')))
                <li class="sidebar-list {{ request()->routeIs('manage-brand-catgeory.*', 'manage-brand-subcategory.*') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"></i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-ecommerce') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                    </svg>
                    <span>Brands</span>
                  </a>
                  <ul class="sidebar-submenu">
                      @if($u->hasPermission('brand-categories.view'))
                          <li><a href="{{ route('manage-brand-catgeory.index') }}" class="{{ request()->routeIs('manage-brand-catgeory.*') ? 'active' : '' }}">Category</a></li>
                      @endif
                      @if($u->hasPermission('brand-subcategories.view'))
                          <li><a href="{{ route('manage-brand-subcategory.index') }}" class="{{ request()->routeIs('manage-brand-subcategory.*') ? 'active' : '' }}">Sub Category</a></li>
                      @endif
                  </ul>
                </li>
                @endif

                @if($u && ($u->hasPermission('home-banners.view') || $u->hasPermission('product-intros.view') || $u->hasPermission('company-stats.view') || $u->hasPermission('home-about.view') || $u->hasPermission('home-clients.view') || $u->hasPermission('testimony-intros.view') || $u->hasPermission('knowledge-spectrum.view') || $u->hasPermission('home-connection.view') || $u->hasPermission('home-events.view')))
                <li class="sidebar-list {{ request()->routeIs('manage-home-banner.*', 'manage-product-intro.*', 'manage-company-stats.*', 'manage-home-about.*', 'manage-home-clients.*', 'manage-testimony-intro.*','manage-home-knowledge-spectrum.*','manage-home-connection.*','manage-home-events.*') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"></i>
                  <a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-landing-page') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#fill-landing-page') }}"></use>
                    </svg>
                    <span>Home</span>
                  </a>
                  <ul class="sidebar-submenu">
                      @if($u->hasPermission('home-banners.view'))
                      <li><a href="{{ route('manage-home-banner.index') }}" class="{{ request()->routeIs('manage-home-banner.*') ? 'active' : '' }}">Banner</a></li>
                      @endif
                      @if($u->hasPermission('product-intros.view'))
                      <li><a href="{{ route('manage-product-intro.index') }}" class="{{ request()->routeIs('manage-product-intro.*') ? 'active' : '' }}">Product Intro</a></li>
                      @endif
                      @if($u->hasPermission('company-stats.view'))
                      <li><a href="{{ route('manage-company-stats.index') }}" class="{{ request()->routeIs('manage-company-stats.*') ? 'active' : '' }}">Company Stats</a></li>
                      @endif

                      @if($u->hasPermission('home-about.view'))
                      <li><a href="{{ route('manage-home-about.index') }}" class="{{ request()->routeIs('manage-home-about.*') ? 'active' : '' }}">About Details</a></li>
                      @endif

                      @if($u->hasPermission('home-clients.view'))
                      <li><a href="{{ route('manage-home-clients.index') }}" class="{{ request()->routeIs('manage-home-clients.*') ? 'active' : '' }}">Client List</a></li>
                      @endif

                      @if($u->hasPermission('testimony-intros.view'))
                      <li><a href="{{ route('manage-testimony-intro.index') }}" class="{{ request()->routeIs('manage-testimony-intro.*') ? 'active' : '' }}">Testimony Intro</a></li>
                      @endif

                      @if($u->hasPermission('knowledge-spectrum.view'))
                      <li><a href="{{ route('manage-home-knowledge-spectrum.index') }}" class="{{ request()->routeIs('manage-home-knowledge-spectrum.*') ? 'active' : '' }}">Knowledge Spectrum</a></li>
                      @endif

                      @if($u->hasPermission('home-connection.view'))
                      <li><a href="{{ route('manage-home-connection.index') }}" class="{{ request()->routeIs('manage-home-connection.*') ? 'active' : '' }}">Connection Info</a></li>
                      @endif

                      @if($u->hasPermission('home-events.view'))
                      <li><a href="{{ route('manage-home-events.index') }}" class="{{ request()->routeIs('manage-home-events.*') ? 'active' : '' }}">Event Intro</a></li>
                      @endif
                  </ul>
                </li>
                @endif


                @if($u && $u->hasPermission('testimonials.view'))
                <li class="sidebar-list {{ request()->routeIs('manage-testimonials.*') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"></i>
                  <a class="sidebar-link sidebar-title link-nav" href="{{ route('manage-testimonials.index') }}">
                    <svg class="stroke-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-layout') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#fill-layout') }}"></use>
                    </svg>
                    <span>Testimonials</span>
                  </a>
                </li>
                @endif

                
                @if($u && $u->hasPermission('contact-details.view'))
                <li class="sidebar-list {{ request()->routeIs('manage-contact-details.*') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"></i>
                  <a class="sidebar-link sidebar-title link-nav" href="{{ route('manage-contact-details.index') }}">
                    <svg class="stroke-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-contact') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#fill-contact') }}"></use>
                    </svg>
                    <span>Contact Details</span>
                  </a>
                </li>
                @endif

                @if($u && $u->hasPermission('activity-logs.view'))
                <li class="sidebar-list {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
                  <i class="fa fa-thumb-tack"></i>
                  <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.activity-logs.index') }}">
                    <svg class="stroke-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-task') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#fill-task') }}"></use>
                    </svg>
                    <span>Activity Log</span>
                  </a>
                </li>
                @endif


              </ul>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </div>