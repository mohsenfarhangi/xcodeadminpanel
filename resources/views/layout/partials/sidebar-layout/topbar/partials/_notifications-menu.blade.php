<?php
    // Content library
    $logs = array(
        array( 'code' => '200 OK', 'state' => 'success', 'message' => 'سفارش جدید', 'time' => 'Just now'),
        array( 'code' => '500 ERR', 'state' => 'danger', 'message' => 'مشتری جدید', 'time' => '2 hrs'),
        array( 'code' => '200 OK', 'state' => 'success', 'message' => 'پروسه پرداخت', 'time' => '5 hrs'),
        array( 'code' => '300 WRN', 'state' => 'warning', 'message' => 'جستجو', 'time' => '2 days'),
        array( 'code' => '200 OK', 'state' => 'success', 'message' => 'اتصال API', 'time' => '1 week'),
        array( 'code' => '200 OK', 'state' => 'success', 'message' => 'بازگردانی دیتابیس', 'time' => 'Mar 5'),
        array( 'code' => '300 WRN', 'state' => 'warning', 'message' => 'بروزرسانی سیستم', 'time' => 'May 15'),
    );
?>

<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
	<!--begin::Heading-->
    <div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('{{ asset('media/misc/pattern-1.jpg') }}')">
        <!--begin::Title-->
        <h3 class="text-white fw-bold px-9 mt-10 mb-6">
            {{__('Notifications')}} <span class="fs-8 opacity-75 ps-3">{{__(':number report',['number'=>24])}}</span>
        </h3>
        <!--end::Title-->

        <!--begin::Tabs-->
        <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-bold px-9">
            <li class="nav-item">
                <a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab" href="#kt_topbar_notifications_3">{{__('Logs')}}</a>
            </li>
        </ul>
        <!--end::Tabs-->
    </div>
	<!--end::Heading-->

    <!--begin::Tab content-->
    <div class="tab-content">
        <!--begin::Tab panel-->
        <div class="tab-pane fade show active" id="kt_topbar_notifications_3" role="tabpanel">
            <!--begin::Items-->
            <div class="scroll-y mh-325px my-5 px-8">
                <?php foreach($logs as $log):?>
                    <!--begin::Item-->
                    <div class="d-flex flex-stack py-4">
                        <!--begin::Section-->
                        <div class="d-flex align-items-center me-2">
                            <!--begin::Code-->
                            <span class="w-70px badge badge-light-{{ $log['state'] }} me-4">{{ $log['code'] }}</span>
                            <!--end::Code-->

                            <!--begin::Title-->
                            <a href="#" class="text-gray-800 text-hover-primary fw-bold">{{ $log['message'] }}</a>
                            <!--end::Title-->
                        </div>
                        <!--end::Section-->

                        <!--begin::Label-->
                        <span class="badge badge-light fs-8">{{ $log['time'] }}</span>
                        <!--end::Label-->
                    </div>
                    <!--end::Item-->
                <?php endforeach?>
            </div>
            <!--end::Items-->

            <!--begin::View more-->
			<div class="py-3 text-center border-top">
                <a href="{{ theme()->getPageUrl('pages/profile/activity') }}" class="btn btn-color-gray-600 btn-active-color-primary">
                    {{__('View All')}}
                    {!! theme()->getSvgIcon("icons/duotone/Navigation/left-2.svg", "svg-icon-5") !!}
                </a>
			</div>
			<!--end::View more-->
        </div>
        <!--end::Tab panel-->
    </div>
    <!--end::Tab content-->
</div>
<!--end::Menu-->
