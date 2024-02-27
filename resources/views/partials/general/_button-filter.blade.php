@php
    $label = $label ?? __('cpanel.filter');
@endphp

<button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
    {!! \App\Http\Core\Adapters\Theme::getSvgIcon('icons/duotune/general/gen031.svg') !!}
    <!--end::Svg Icon-->
    {{$label}}
</button>
