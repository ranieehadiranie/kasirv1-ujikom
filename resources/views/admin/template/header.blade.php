<!-- filepath: c:\Users\Hadiranie\KasirV1\resources\views\admin\template\header.blade.php -->
<div id="kt_header" class="header">
    <head>
        <!-- Favicon -->
        <link rel="icon" type="image/jpeg" href="{{ asset('assets/media/logos/cashierlogo.jpeg') }}">
    </head>
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-center flex-wrap justify-content-between" id="kt_header_container">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-2 pb-5 pb-lg-0 pt-7 pt-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
            <!--begin::Heading-->
            <h1 class="d-flex flex-column text-gray-900 fw-bold my-0 fs-1">    
            </h1>
            <!--end::Heading-->
        </div>
        <!--end::Page title=-->
        <!--begin::Wrapper-->
        <div class="d-flex d-lg-none align-items-center ms-n4 me-2">
            <!--begin::Aside mobile toggle-->
            <div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
                <i class="ki-duotone ki-abstract-14 fs-1 mt-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
            <!--end::Aside mobile toggle-->
            <!--begin::Logo-->
            <a href="index.html" class="d-flex align-items-center">
                <img alt="Logo" src="assets/media/logos/cashierlogo.jpeg" class="h-30px" />
            </a>
            <!--end::Logo-->
        </div>
    </div>
    <!--end::Container-->
</div>