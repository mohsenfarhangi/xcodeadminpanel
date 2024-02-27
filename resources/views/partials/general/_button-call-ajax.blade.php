@php
    $label = $label ?? __('cpanel.send');
@endphp

<!--begin::Add customer-->
<button type="button" class="button-ajax btn btn-primary me-3"
        data-action="{{$action ?? ''}}"
        data-csrf="{{$csrf ?? csrf_token()}}"
        data-reload="{{$reload ?? false}}">
    {{$label}}
</button>
<!--end::Add customer-->
