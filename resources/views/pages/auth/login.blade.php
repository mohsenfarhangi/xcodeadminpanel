<x-auth-layout>

    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
          data-kt-redirect-url="{{route('dashboard')}}" method="post" action="/login">
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-dark fw-bolder mb-3">{{__('auth.Log in')}}</h1>
            <!--end::Title-->
            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">{{__('auth.sign_in_to_account')}}</div>
            <!--end::Subtitle=-->
        </div>
        <!--begin::Heading-->
        <!--begin::Input group=-->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input type="text" placeholder="{{__('auth.email')}}" name="email" value="demo@demo.com" autocomplete="off" class="form-control bg-transparent"/>
            <!--end::Email-->
        </div>
        <!--end::Input group=-->
        <div class="fv-row mb-3">
            <!--begin::Password-->
            <input type="password" placeholder="{{__('auth.password')}}" name="password" value="demo" autocomplete="off"
                   class="form-control bg-transparent"/>
            <!--end::Password-->
        </div>
        <!--end::Input group=-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div></div>
            <!--begin::Link-->
            <a href="{{route('password.request')}}" class="link-primary">{{__('auth.Forgot Password ?')}}</a>
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                @include('partials.general._button-indicator',['label'=>__('auth.submit')])
            </button>
        </div>
        <!--end::Submit button-->
    </form>
    <!--end::Form-->

</x-auth-layout>
