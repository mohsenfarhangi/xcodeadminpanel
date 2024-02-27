<!--begin::Search-->
<div class="d-flex align-items-center position-relative my-1">
    <span class="svg-icon svg-icon-1 position-absolute ms-6">
        {!! \App\Http\Core\Adapters\Theme::getSvgIcon("icons/duotune/general/gen021.svg") !!}
    </span>
    <!--end::Svg Icon-->
    <input type="text" data-table-filter="search" class="form-control form-control-solid w-250px ps-15"
           placeholder="{{__('cpanel.search')}}"/>
</div>
<!--end::Search-->
