<!--begin::Actions-->
<div class="d-flex my-4">
    <!--begin::Menu-->
    <div class="me-0">
        <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
            <i class="bi bi-three-dots fs-3"></i>
        </button>
        <!--begin::Menu 3-->
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
            <!--begin::Heading-->
            <div class="menu-item px-3">
                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">{{__('cpanel.quick_actions')}}</div>
            </div>
            <!--end::Heading-->
            @if(false)
                    <!--begin::Menu item-->
                    <div class="menu-item px-3 my-1">
                        <a href="javascript:" class="edit-shift-work menu-link px-3" data-bs-toggle="modal" data-bs-target="#edit_shift_work">
                            {{__('cpanel.Editing work shifts')}}
                        </a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-3 my-1">
                        <a href="#" class="menu-link px-3">{{__('cpanel.send')}} {{__('cpanel.notification')}}</a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-3 my-1">
                        <a href="#" class="menu-link px-3">{{__('cpanel.send_private_sms')}}</a>
                    </div>
                    <!--end::Menu item-->
            @endif

        </div>
        <!--end::Menu 3-->
    </div>
    <!--end::Menu-->
</div>
<!--end::Actions-->
