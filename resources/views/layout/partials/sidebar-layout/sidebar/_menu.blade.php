<?php
$menu = \App\Http\Core\Adapters\Bootstrap::getAsideMenu();
?>
<!--begin::Nav-->
<div class="aside-menu flex-column-fluid pt-0 pb-7 py-lg-10" id="kt_aside_menu">
    <!--begin::Aside menu-->
    <div id="kt_aside_menu_wrapper"
         class="w-100 hover-scroll-overlay-y scroll-ps d-flex"
         data-kt-scroll="true"
         data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
         data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu"
         data-kt-scroll-offset="0">
        <div id="kt_aside_menu"
             class="menu menu-column menu-rounded menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-icon-gray-400 menu-arrow-gray-400 fw-semibold fs-6"
             data-kt-menu="true">
            <?php
            $menu->build();
            ?>
        </div>
    </div>
    <!--end::Aside menu-->
</div>
<!--end::Nav-->
