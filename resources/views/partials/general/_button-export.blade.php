@php
    $label = $label ?? __('cpanel.export');
@endphp
<!--begin::Export-->
<button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#export_modal">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
    {!! \App\Http\Core\Adapters\Theme::getSvgIcon('icons/duotune/arrows/arr078.svg') !!}
    <!--end::Svg Icon-->
    {{$label}}
</button>
<!--end::Export-->
