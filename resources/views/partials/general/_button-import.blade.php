@php
    $label = $label ?? __('cpanel.import');
@endphp
<!--begin::Export-->
<button type="button" class="btn btn-secondary me-3" data-bs-toggle="modal" data-bs-target="#import_modal">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
    {!! \App\Http\Core\Adapters\Theme::getSvgIcon('icons/duotune/arrows/arr091.svg') !!}
    <!--end::Svg Icon-->
    {{$label}}
</button>
<!--end::Export-->
