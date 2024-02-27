<div class="card modal-cred">
    <div class="card-header">

        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-admin-table-toolbar="base">

                @can("admin_create")
                    @include('partials.general._button-create-card')
                @endcan
                <!--begin::Filter-->
{{--                @include('partials.general._button-filter')--}}
                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true"
                     id="kt-toolbar-filter">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-4 text-dark fw-bold">{{__('cpanel.filter')}}</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Content-->
                    <div class="px-7 py-5">
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fs-5 fw-semibold mb-3">{{__('cpanel.role select')}}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                    data-placeholder="{{__('cpanel.role select')}}" data-allow-clear="true"
                                    data-admin-table-filter="month" data-dropdown-parent="#kt-toolbar-filter">
                                <option></option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                                    data-kt-menu-dismiss="true" data-admin-table-filter="reset">{{__('cpanel.reset')}}
                            </button>
                            <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true"
                                    data-admin-table-filter="filter">{{__('cpanel.filter')}}
                            </button>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Menu 1-->
                <!--end::Filter-->
            </div>
            <!--end::Toolbar-->
            <!--begin::Group actions-->
            <div class="d-flex justify-content-end align-items-center d-none"
                 data-admin-table-toolbar="selected">
                <div class="fw-bold me-5">
                    <span class="me-2" data-table-select="selected_count"></span>
                    {{__('cpanel.selected')}}
                </div>
                <button type="button" class="btn btn-danger" data-table-select="delete_selected">
                    {{__('cpanel.Delete Selected')}}
                </button>
            </div>
            <!--end::Group actions-->
        </div>
        <!--end::Card toolbar-->

        <!--begin::Card title-->
        <div class="card-title">

            @include('partials.general._search-card')
        </div>
        <!--begin::Card title-->

    </div>

    <div class="card-body pt-6">
        {!! csrf_field() !!}
        {!! method_field('delete') !!}

        {{ $dataTable->table() }}
    </div>
</div>
