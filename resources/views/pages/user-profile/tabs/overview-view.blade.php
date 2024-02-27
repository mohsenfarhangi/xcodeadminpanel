<!--begin::Card header-->
<div class="card-header cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
        <h3 class="fw-bold m-0">{{__('cpanel.details')}}</h3>
    </div>
    <!--end::Card title-->
    <!--begin::Action-->
    @can("user_profile_edit")
        <a href="#" class="btn btn-sm btn-primary align-self-center edit-account-btn">{{__('cpanel.edit')}}</a>

        @include("partials.general._button-save",['class' => 'btn-sm align-self-center btn-save-account d-none'])
    @endcan
    <!--end::Action-->
</div>
<!--begin::Card header-->
<!--begin::Card body-->
<div class="card-body p-9">
    <div class="row">
        <div class="col-md-6">
            <form action="" method="post" id="diver_details">
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-2 fw-bold fs-5 text-muted">{{__('cpanel.name')}}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-10">
                        <span class="fw-bold fs-6 text-gray-800 span-value">{{$user->full_name ?? '-'}}</span>
                        <input class="form-control d-none account-detail-input" type="text" name="full_name"
                               id="full_name"
                               value="{{$user->full_name ?? '-'}}">
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-2  fw-bold fs-5 text-muted">
                        {{__('cpanel.phone')}}
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-10 d-flex align-items-center">
                        <span class="fw-bold fs-6 text-gray-800 me-2 span-value">{{$user->mobile ?? '-'}}</span>
                        <input class="form-control d-none account-detail-input" type="text" name="mobile" id="mobile"
                               value="{{$user->mobile ?? '-'}}">
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-2  fw-bold fs-5 text-muted">
                        {{__('cpanel.email')}}
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-10 d-flex align-items-center">
                        <span class="fw-bold fs-6 text-gray-800 me-2 span-value">{{$user->email ?? '-'}}</span>
                        <input class="form-control d-none account-detail-input" type="text" name="email" id="email"
                               value="{{$user->email ?? '-'}}">
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-2  fw-bold fs-5 text-muted">
                        {{__('cpanel.birth_date')}}
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-10 d-flex align-items-center">
                        <span
                            class="fw-bold fs-6 text-gray-800 me-2 span-value">{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d',strtotime($user->birth_date ?? ''))}}</span>
                        <input type="text"
                               class="form-control form-control-solid pdatepicker d-none account-detail-input"
                               name="birth_date"
                               value="{{ old('birth_date', $user->birth_date ?? '') }}" maxlength="10"
                               readonly>
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-2  fw-bold fs-5 text-muted">
                        {{__('cpanel.agent')}}
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-10 d-flex align-items-center">
                        @php
                            $agent = $user->getAgentDetails();
                        @endphp
                        <span class="fw-bold fs-6 text-gray-800 me-2 span-value">{{$agent->full_name ?? '-'}}</span>
                        <select class="form-select form-select-solid account-detail-input d-none" id="agent_id"
                                name="status" data-control="select2"
                                data-placeholder="{{ __('cpanel.agent') }}" data-allow-clear="true">
                            @if(!empty($agent))
                                <option value="{{$agent->id ?? ''}}">{{$agent->full_name ?? ''}}</option>
                            @endif

                        </select>
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-2  fw-bold fs-5 text-muted">{{__('cpanel.province')}}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-10">
                        <span class="fw-bold fs-6 text-gray-800 span-value">{{$user->province->name ?? ''}}</span>
                        <select class="form-select form-select-solid province-select d-none account-detail-input"
                                id="province_id"
                                name="province_id" data-control="select2" data-select="state"
                                data-placeholder="{{ __('cpanel.province') }}" data-allow-clear="true">
                            <option value="">{{__('cpanel.province')}}</option>
                            @foreach($provinces as $record)
                                <option
                                    value="{{ $record->id }}" {{($user->province_id ?? '') == $record->id ? 'selected' : ''}}>{{ $record->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-2  fw-bold fs-5 text-muted">
                        {{__('cpanel.city')}}
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-10">
                        <span class="fw-bold fs-6 text-gray-800 span-value">{{$user->city->name ?? ''}}</span>
                        <select class="form-select form-select-solid d-none account-detail-input" id="city_id"
                                name="city_id" data-control="select2"
                                data-placeholder="{{ __('cpanel.city') }}" data-allow-clear="true" data-show="city">
                            <option value="">{{__('cpanel.city')}}</option>
                            @foreach($cities as $city)
                                <option
                                    value="{{$city->id ?? ''}}" {{$user->city_id == $city->id ? 'selected' : ''}}>{{$city->name ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-7">
                    <!--begin::Label-->
                    <label class="col-lg-2  fw-bold fs-5 text-muted">
                        {{__('cpanel.status')}}
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-10 d-flex align-items-center">
                        <span
                            class="fw-bold fs-6 text-gray-800 me-2 span-value">{!! getUserStatuses($user->status)['label'] ?? '' !!}</span>
                        <select class="form-select form-select-solid account-detail-input d-none" id="status"
                                name="status" data-control="select2"
                                data-placeholder="{{ __('cpanel.status_select') }}" data-allow-clear="true">

                            @foreach(getUserStatuses() as $key => $record)
                                <option
                                    value="{{ $key }}" {{($user->status ?? '') == $key ? 'selected' : ''}}>{{ $record['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::Col-->
                </div>
            </form>
        </div>
    </div>

</div>
<!--end::Card body-->

