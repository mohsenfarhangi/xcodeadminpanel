<!--begin::details View-->
<div class="card mb-5 mb-xl-10" id="profile_shift_work_view">
    <!--begin::Card header-->
    <div class="card-header cursor-pointer">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">{{__('cpanel.address')}}</h3>
        </div>
        <!--end::Card title-->
        <div class="align-self-center">
            @can("user_profile_address_edit")
                @include("partials.general._button-save",['class' => 'btn-save-address'])
            @endcan

        </div>
    </div>
    <!--begin::Card header-->
    <!--begin::Card body-->
    <div class="card-body p-9">
        <form action="" method="post" id="user_address">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h5>
                            {{__('cpanel.Registered addresses')}}
                        </h5>
                        <div class="d-flex justify-content-between">
                            <div class="addresses-container">
                                @foreach($user->getAllAddresses() as $address)
                                    <button type="button" class="btn btn-secondary registered-location"
                                            data-location-id="{{$address['id']}}" data-bs-toggle="tooltip"
                                            title="{{$address['address']}}">
                                        {!! \App\Http\Core\Adapters\Theme::getSvgIcon('icons/duotune/maps/map001.svg') !!}
                                        {{$address['title']}}
                                    </button>
                                @endforeach
                            </div>
                            <div>
                                @if(count($user->getAllAddresses()) < 4)
                                    <button type="button"
                                            class="btn btn-primary btn-empty-address-form">{{__('cpanel.add_new')}}
                                    </button>
                                @endif
                                    <button type="button"
                                            class="btn btn-danger btn-remove-address-form d-none">{{__('cpanel.remove')}}
                                    </button>

                            </div>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="col-md-6 fv-row">
                        <label class="required form-label" for="address_title">
                            {{__('cpanel.title')}}
                        </label>
                        <input type="text" class="form-control form-control-solid" name="address_title"
                               id="address_title">
                    </div>
                    <div class="col-md-6 fv-row">
                        <label class="required form-label" for="address_province_id">
                            {{__('cpanel.province')}}
                        </label>
                        <select class="form-select form-select-solid province-select"
                                id="address_province_id"
                                name="address_province_id" data-control="select2" data-select="state"
                                data-placeholder="{{ __('cpanel.province') }}" data-allow-clear="true">
                            <option value="">{{__('cpanel.province')}}</option>
                            @foreach($provinces as $record)
                                <option value="{{ $record->id }}">{{ $record->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 fv-row">
                        <label class="required form-label" for="address_city_id">
                            {{__('cpanel.city')}}
                        </label>
                        <select class="form-select form-select-solid" id="address_city_id"
                                name="address_city_id" data-control="select2"
                                data-placeholder="{{ __('cpanel.city') }}" data-allow-clear="true" data-show="city">
                            <option value="">{{__('cpanel.city')}}</option>
                        </select>
                    </div>
                    <div class="col-md-12 fv-row">
                        <label class="required form-label" for="address">
                            {{__('cpanel.address')}}
                        </label>
                        <textarea class="form-control" name="address_format" id="address_format" cols="30"
                                  rows="5">{{$user->address}}</textarea>
                    </div>
                    <hr class="my-3">
                    <div class="col-md-12 ">
                        <div class="mb-3">
                            <label class="required form-label">{{__('cpanel.map')}}</label>
                            <div class="row">
                                <div class="col-md-6 fv-row">
                                    <input type="text" name="address[lat]" class="form-control form-control-solid"
                                           placeholder="{{__('cpanel.latitude')}}"
                                           value="{{$user->geo_points['latitude']}}"/>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <input type="text" name="address[lng]" class="form-control form-control-solid"
                                           placeholder="{{__('cpanel.longitude')}}"
                                           value="{{$user->geo_points['longitude']}}"/>
                                </div>

                            </div>
                        </div>
                        <input type="hidden" name="city_lat" value="{{$user->city->geo_points['latitude'] ?? ''}}">
                        <input type="hidden" name="city_lng" value="{{$user->city->geo_points['longitude'] ?? ''}}">
                        <input type="hidden" name="address_id" value="">
                        <div id="address_map" style="height: 400px"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--end::Card body-->
</div>
<!--end::details View-->
