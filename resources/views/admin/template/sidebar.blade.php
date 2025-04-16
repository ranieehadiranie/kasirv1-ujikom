<div id="kt_aside" class="aside pt-7 pb-4 pb-lg-7 pt-lg-17" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto px-9 mb-9 mb-lg-17 mx-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="index.html">
            <img alt="Logo" src="{{asset("assets/media/logos/cashierlogo.jpeg")}}" class="h-30px logo theme-light-show" />
            <img alt="Logo" src="{{asset("assets/media/logos/cashierlogo.jpeg")}}" class="h-30px logo theme-dark-show" /> Aplikasi Kasir
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside user-->
    <div class="aside-user mb-5 mb-lg-10" id="kt_aside_user">
        <!--begin::User-->
        <div class="d-flex align-items-center flex-column">
            <!--begin::Symbol-->
            <div class="symbol symbol-75px mb-4">
                <img src="{{asset("assets/media/avatars/userlogo.jpg")}}" alt="" />
            </div>
            <!--end::Symbol-->
            <!--begin::Info-->
            <div class="text-center">
                <!--begin::Username-->
                <a href="pages/user-profile/overview.html" class="text-gray-800 text-hover-primary fs-4 fw-bolder">{{ Auth::user()->name}}</a>
                <!--end::Username-->
                <!--begin::Description-->
                <span class="text-gray-600 fw-semibold d-block fs-7 mb-1">{{ Auth::user()->role}}</span>
                <!--end::Description-->
            </div>
            <!--end::Info-->
        </div>
        <!--end::User-->
    </div>
    <!--end::Aside user-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid ps-3 ps-lg-5 pe-1 mb-9" id="kt_aside_menu">
        <!--begin::Aside Menu-->
        <div class="w-100 hover-scroll-y pe-2 me-2" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_user, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu, #kt_aside_menu_wrapper" data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold" id="#kt_aside_menu" data-kt-menu="true">
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                    <!--begin:Menu link-->
                    <a href="{{route('dashboard')}}" class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-home-2 fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Dashboards</span>
                </a>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-gift fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </span>
                        <span class="menu-title">Produk</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <!--begin:Menu link-->
                            <a href="{{route('produk.index')}}" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Produk</span>
                            </a>                          
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                    
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-abstract-26 fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Penjualan</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <!--begin:Menu link-->
                            <a href="{{route('penjualan.index')}}" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Penjualan</span>
                               
                            </a>
                        
                        </div>
                       
                       

                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <a href="{{route('produk.logproduk')}}">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-abstract-35 fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Produk Log</span>
                      
                    </span>
                    </a>
                </div>
                

                @if (Auth::user()->role == 'administrator')
                <div class="menu-item">
                    <a class="menu-link text-hover-gray-300" href="{{ route('petugas-requests.index') }}">
                        <span class="menu-icon">
                            <i class="fas fa-user-plus text-white fs-1"></i>
                        </span>
                        <span class="menu-title text-white text-hover-gray-300">daftarkan Petugas</span>
                    </a>
                </div>
            @endif
                <!--end:Menu item-->
                <!--begin:Menu item-->
              
                <!--end:Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
    <!--begin::Footer-->
    <div class="aside-footer flex-column-auto px-6 px-lg-9" id="kt_aside_footer">
        <!--begin::User panel-->
        <div class="d-flex flex-stack ms-7">
            <!--begin::Link-->
            <a href="{{route('logout')}}" class="btn btn-sm btn-icon btn-active-color-primary btn-icon-gray-600 btn-text-gray-600">
                <i class="ki-duotone ki-entrance-left fs-1 me-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <!--begin::Major-->
                <span class="d-flex flex-shrink-0 fw-bold">Log Out</span>
                <!--end::Major-->
            </a>

        </div>
        <!--end::User panel-->
    </div>
    <!--end::Footer-->
</div>