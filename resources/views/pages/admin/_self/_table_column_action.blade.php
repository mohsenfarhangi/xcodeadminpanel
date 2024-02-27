<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click"
   data-kt-menu-placement="bottom-end">
    عملیات
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
    {!! \App\Http\Core\Adapters\Theme::getSvgIcon('icons/duotune/arrows/arr072.svg') !!}
    <!--end::Svg Icon--></a>
<!--begin::Menu-->
<div
    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
    data-kt-menu="true">
    <!--begin::Menu item-->
    @can("admin_update")
        <div class="menu-item px-3">
            <button class="btn btn-show-data w-100 text-center menu-link px-3">{{__('cpanel.edit')}}</button>
        </div>
    @endcan
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        @can("admin_delete")
            <button id="data-table-remove" class="btn menu-link px-3 w-100 text-center">{{__('cpanel.remove')}}</button>
        @endcan
    </div>
    <!--end::Menu item-->
</div>
<!--end::Menu-->
