<!--begin::Navbar-->
<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
            @include('pages.user-profile.partials._navbar_picture')
            <!--begin::Info-->
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    @include("pages.user-profile.partials._navbar_user_info")
                    @include("pages.user-profile.partials._navbar_actions")
                </div>
            </div>
            <!--end::Info-->
        </div>
        <!--end::Details-->
        @include("pages.user-profile.partials._navbar_tab_title")
    </div>
</div>
<!--end::Navbar-->
