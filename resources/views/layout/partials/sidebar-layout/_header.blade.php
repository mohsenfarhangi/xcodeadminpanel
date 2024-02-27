<!--begin::Header tablet and mobile-->
<div class="header-mobile py-3">
    <!--begin::Container-->
    <div class="container d-flex flex-stack">
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{route('dashboard')}}">
                <img alt="Logo" src="{{ asset($settings['logo-mobile']) }}" class="h-40px"/>
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Aside toggle-->
        <button class="btn btn-icon btn-active-color-primary" id="kt_aside_toggle">
            <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
            {!! App\Http\Core\Theme\Theme::getSvgIcon('duotune/abstract/abs015.svg', 'svg-icon svg-icon-1') !!}
            <!--end::Svg Icon-->
        </button>
        <!--end::Aside toggle-->
    </div>
    <!--end::Container-->
</div>
<!--end::Header tablet and mobile-->
<!--begin::Header-->
<div id="kt_header" class="header py-6 py-lg-0" data-kt-sticky="true" data-kt-sticky-name="header"
     data-kt-sticky-offset="{lg: '300px'}">
    <!--begin::Container-->
    <div class="header-container container-xxl">
        @include(config('theme.general.KT_THEME_LAYOUT_DIR').'/partials/sidebar-layout/_page-title')
        @include(config('theme.general.KT_THEME_LAYOUT_DIR').'/partials/sidebar-layout/topbar/_base')
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->
