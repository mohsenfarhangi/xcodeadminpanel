<!--begin::User-->
<div class="d-flex flex-column">
    <!--begin::Name-->
    <div class="d-flex align-items-center mb-2">
        <a href="javascript:" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{$user->full_name}}</a>
    </div>
    <!--end::Name-->
    <!--begin::Info-->
    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2"
           data-bs-toggle="tooltip" title="{{__('cpanel.driver code')}}">
            {!! \App\Http\Core\Adapters\Theme::getSvgIcon('icons/duotune/general/gen022.svg') !!}
            {{$user->user_code ?? ''}}
        </a>
        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
            {!! \App\Http\Core\Adapters\Theme::getSvgIcon('icons/duotune/general/gen018.svg') !!}
            {{$user->province->name ?? ''}} {{$user->city->name ?? ''}}
        </a>

    </div>
    <!--end::Info-->
</div>
<!--end::User-->
