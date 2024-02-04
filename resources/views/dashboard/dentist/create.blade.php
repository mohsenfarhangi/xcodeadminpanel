<x-app-layout>
    @include("dashboard.dentist._datatable")
    <div class="table-action mb-3">
        <a href="{{route('dentist.create')}}" class="btn btn-success">درج</a>
        <button class="btn btn-warning edit-dentists" data-url="{{route('dentist.edit',['dentist'=>'-id-'])}}">ویرایش
        </button>
        @if(!request()->routeIs('dentist.edit'))
            <button class="btn btn-danger remove-dentists" data-url="{{route('dentist.destroy',['dentist'=>'-id-'])}}">حذف
            </button>
        @endif
    </div>
    <div class="card">
        <form
            action="{{request()->routeIs('dentist.create') ? route('dentist.store') : route('dentist.update',['dentist'=>$dentist->id])}}"
            method="post">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        درج دندانپزشک
                    </h5>

                    <div class="guide-wrp">
                        <button class="btn btn-link">راهنما</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <x-form-errors :errors="$errors"/>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row mb-3 mx-2">
                                <x-input-label for="first_name" :value="__('نام:')" class="col-md-3 col-form-label"
                                               :required="true"/>
                                <div class="col-md-9">
                                    <x-text-input id="first_name" type="first_name" name="first_name"
                                                  :value="old('first_name',$dentist->first_name ?? '')"
                                                  autofocus
                                                  autocomplete="first_name"/>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="last_name" :value="__('نام خانوادگی:')"
                                               class="col-md-3 col-form-label" :required="true"/>
                                <div class="col-md-9">
                                    <x-text-input id="last_name" type="last_name" name="last_name"
                                                  :value="old('last_name',$dentist->last_name ?? '')"
                                                  autocomplete="last_name"/>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="dr_number" :value="__('نظام پزشکی:')"
                                               class="col-md-3 col-form-label" :required="true"/>
                                <div class="col-md-9">
                                    <x-text-input id="dr_number" type="dr_number" name="dr_number"
                                                  :value="old('dr_number',$dentist->dr_number ?? '')"
                                                  autocomplete="dr_number"/>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="percent" :value="__('درصد:')" class="col-md-3 col-form-label"/>
                                <div class="col-md-9">
                                    <x-text-input id="percent" type="percent" name="percent"
                                                  :value="old('percent',$dentist->percent ?? '')"
                                                  autocomplete="percent"/>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="birth_date" :value="__('تاریخ تولد:')"
                                               class="col-md-3 col-form-label"/>
                                <div class="col-md-9">
                                    <x-text-input id="birth_date" type="birth_date" name="birth_date"
                                                  :value="old('birth_date',$dentist->birth_date ?? '')"
                                                  autocomplete="birth_date"/>
                                </div>
                            </div>

                            <div class="row mb-3 mx-2">
                                <x-input-label for="gender" :value="__('جنسیت:')" class="col-md-3 col-form-label"/>
                                <div class="col-md-9">
                                    <x-dropdown id="gender" name="gender" :options="['male'=>'مرد','female'=>'زن']"
                                                :current="old('gender',$dentist->gender ?? '')"
                                                autocomplete="gender"/>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="bank_name" :value="__('نام بانک:')"
                                               class="col-md-3 col-form-label"/>
                                <div class="col-md-9">
                                    <x-text-input id="bank_name" type="bank_name" name="bank_name"
                                                  :value="old('bank_name',$dentist->bank_name ?? '')"
                                                  autocomplete="bank_name"/>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="bank_account_number" :value="__('شماره حساب:')"
                                               class="col-md-3 col-form-label"/>
                                <div class="col-md-9">
                                    <x-text-input id="bank_account_number" type="bank_account_number"
                                                  name="bank_card_number"
                                                  :value="old('bank_account_number',$dentist->bank_account_number ?? '')"
                                                  autocomplete="bank_account_number"/>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="bank_card_number" :value="__('شماره کارت:')"
                                               class="col-md-3 col-form-label"/>
                                <div class="col-md-9">
                                    <x-text-input id="bank_card_number" type="bank_card_number" name="bank_card_number"
                                                  :value="old('bank_card_number',$dentist->bank_card_number ?? '')"
                                                  autocomplete="bank_card_number"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row mb-3 mx-2">
                                <x-input-label for="speciality" :value="__('تخصص:')" class="col-md-3 col-form-label"
                                               :required="true"/>
                                <div class="col-md-9">
                                    <x-text-input id="speciality" type="speciality" name="speciality"
                                                  :value="old('speciality',$dentist->speciality ?? '')"
                                                  autocomplete="speciality"/>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="conversance" :value="__('تبحر:')" class="col-md-3 col-form-label"/>
                                <div class="col-md-9">
                                    <x-text-input id="conversance" type="conversance" name="conversance"
                                                  :value="old('conversance',$dentist->conversance ?? '')"
                                                  autocomplete="conversance"/>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="university" :value="__('دانشگاه:')"
                                               class="col-md-3 col-form-label"/>
                                <div class="col-md-9">
                                    <x-text-input id="university" type="university" name="university"
                                                  :value="old('university',$dentist->university ?? '')"
                                                  autocomplete="university"/>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="presenter" :value="__('معرف:')" class="col-md-3 col-form-label"/>
                                <div class="col-md-9">
                                    <x-text-input id="presenter" type="presenter" name="presenter"
                                                  :value="old('presenter',$dentist->presenter ?? '')"
                                                  autocomplete="presenter"/>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="dossier" :value="__('سابقه:')" class="col-md-3 col-form-label"/>
                                <div class="col-md-9">
                                    <x-text-input id="dossier" type="dossier" name="dossier"
                                                  :value="old('dossier',$dentist->dossier ?? '')"
                                                  autocomplete="dossier"/>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="insuranceNum" :value="__('شماره بیمه:')"
                                               class="col-md-3 col-form-label"/>
                                <div class="col-md-9">
                                    <x-text-input id="insuranceNum" type="insuranceNum" name="insuranceNum"
                                                  :value="old('insuranceNum',$dentist->insuranceNum ?? '')"
                                                  autocomplete="insuranceNum"/>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="phone" :value="__('تلفن:')" class="col-md-3 col-form-label"/>
                                <div class="col-md-9">
                                    <x-text-input id="phone" type="phone" name="phone"
                                                  :value="old('phone',$dentist->phone ?? '')"
                                                  autocomplete="phone"/>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="mobile" :value="__('موبایل:')" class="col-md-3 col-form-label"
                                               :required="true"/>
                                <div class="col-md-9">
                                    <x-text-input id="mobile" type="mobile" name="mobile"
                                                  :value="old('mobile',$dentist->mobile ?? '')"
                                                  autocomplete="mobile"/>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label :value="__('پیامک خلاصه عملکرد:')" class="col-md-5 col-form-label"/>
                                <div class="col-md-7">
                                    <div class="form-check d-inline-block ms-3">
                                        <input class="form-check-input" type="radio" name="dentist_abstract"
                                               id="dentist_abstract_y"
                                               value="1" {{ old('dentist_abstract',$dentist->dentist_abstract ?? 1) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dentist_abstract_y">
                                            بلی
                                        </label>
                                    </div>
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="radio" name="dentist_abstract"
                                               id="dentist_abstract_n"
                                               value="2" {{ old('dentist_abstract',$dentist->dentist_abstract ?? 1) == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dentist_abstract_n">
                                            خیر
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label :value="__('پیامک قرارملاقات:')" class="col-md-5 col-form-label"/>
                                <div class="col-md-7">
                                    <div class="form-check d-inline-block ms-3">
                                        <input class="form-check-input" type="radio" name="dentist_visit_sms"
                                               id="dentist_visit_sms_y"
                                               value="1" {{ old('dentist_visit_sms',$dentist->dentist_visit_sms ?? 1) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dentist_visit_sms_y">
                                            بلی
                                        </label>
                                    </div>
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="radio" name="dentist_visit_sms"
                                               id="dentist_visit_sms_n"
                                               value="2" {{ old('dentist_visit_sms',$dentist->dentist_visit_sms ?? 1) == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dentist_visit_sms_n">
                                            خیر
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="row mb-3 mx-2">
                                <x-input-label for="work_address" :value="__('محل کار:')"
                                               class="col-md-3 col-form-label"/>
                                <div class="col-md-9">
                                <textarea id="work_address" type="work_address" name="work_address"
                                          autocomplete="work_address"
                                          class="form-control">{{old('work_address',$dentist->work_address ?? '')}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="home_address" :value="__('آدرس منزل:')"
                                               class="col-md-3 col-form-label"/>
                                <div class="col-md-9">
                                <textarea id="home_address" type="home_address" name="home_address"
                                          autocomplete="home_address"
                                          class="form-control">{{old('home_address',$dentist->home_address ?? '')}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3 mx-2">
                                <x-input-label for="sort" :value="__('ترتیب نمایش:')" class="col-md-3 col-form-label"/>
                                <div class="col-md-9">
                                    <x-text-input id="sort" type="sort" name="sort"
                                                  :value="old('sort',$dentist->sort ?? 0)"
                                                  autocomplete="sort"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <h5 class="card-title">
                            ساعت حضور
                        </h5>

                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center">
                                        صبح
                                    </td>
                                    <td class="text-center">ظهر</td>
                                    <td class="text-center">عصر</td>
                                    <td class="text-center">شب</td>
                                </tr>
                                <tr>
                                    <td>شنبه</td>
                                    <td>
                                        <x-morning-select-time :day="'saturday'"
                                                               :data="$dentist->formatted_times['saturday']['morning'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-noon-select-time :day="'saturday'"
                                                            :data="$dentist->formatted_times['saturday']['noon'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-afternoon-select-time :day="'saturday'"
                                                                 :data="$dentist->formatted_times['saturday']['afternoon'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-night-select-time :day="'saturday'"
                                                             :data="$dentist->formatted_times['saturday']['night'] ?? []"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>یکشنبه</td>
                                    <td>
                                        <x-morning-select-time :day="'sunday'"
                                                               :data="$dentist->formatted_times['sunday']['morning'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-noon-select-time :day="'sunday'"
                                                            :data="$dentist->formatted_times['sunday']['noon'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-afternoon-select-time :day="'sunday'"
                                                                 :data="$dentist->formatted_times['sunday']['afternoon'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-night-select-time :day="'sunday'"
                                                             :data="$dentist->formatted_times['sunday']['night'] ?? []"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>دوشنبه</td>
                                    <td>
                                        <x-morning-select-time :day="'monday'"
                                                               :data="$dentist->formatted_times['monday']['morning'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-noon-select-time :day="'monday'"
                                                            :data="$dentist->formatted_times['monday']['noon'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-afternoon-select-time :day="'monday'"
                                                                 :data="$dentist->formatted_times['monday']['afternoon'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-night-select-time :day="'monday'"
                                                             :data="$dentist->formatted_times['monday']['night'] ?? []"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>سه‌شنبه</td>
                                    <td>
                                        <x-morning-select-time :day="'tuesday'"
                                                               :data="$dentist->formatted_times['tuesday']['morning'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-noon-select-time :day="'tuesday'"
                                                            :data="$dentist->formatted_times['tuesday']['noon'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-afternoon-select-time :day="'tuesday'"
                                                                 :data="$dentist->formatted_times['tuesday']['afternoon'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-night-select-time :day="'tuesday'"
                                                             :data="$dentist->formatted_times['tuesday']['night'] ?? []"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>چهارشنبه</td>
                                    <td>
                                        <x-morning-select-time :day="'wednesday'"
                                                               :data="$dentist->formatted_times['wednesday']['morning'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-noon-select-time :day="'wednesday'"
                                                            :data="$dentist->formatted_times['wednesday']['noon'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-afternoon-select-time :day="'wednesday'"
                                                                 :data="$dentist->formatted_times['wednesday']['afternoon'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-night-select-time :day="'wednesday'"
                                                             :data="$dentist->formatted_times['wednesday']['night'] ?? []"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>پنج شنبه</td>
                                    <td>
                                        <x-morning-select-time :day="'thursday'"
                                                               :data="$dentist->formatted_times['thursday']['morning'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-noon-select-time :day="'thursday'"
                                                            :data="$dentist->formatted_times['thursday']['noon'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-afternoon-select-time :day="'thursday'"
                                                                 :data="$dentist->formatted_times['thursday']['afternoon'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-night-select-time :day="'thursday'"
                                                             :data="$dentist->formatted_times['thursday']['night'] ?? []"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>جمعه</td>
                                    <td>
                                        <x-morning-select-time :day="'friday'"
                                                               :data="$dentist->formatted_times['friday']['morning'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-noon-select-time :day="'friday'"
                                                            :data="$dentist->formatted_times['friday']['noon'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-afternoon-select-time :day="'friday'"
                                                                 :data="$dentist->formatted_times['friday']['afternoon'] ?? []"/>
                                    </td>
                                    <td>
                                        <x-night-select-time :day="'friday'"
                                                             :data="$dentist->formatted_times['friday']['night'] ?? []"/>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <x-primary-button>ذخیره</x-primary-button>
                <a href="{{route('dentist.create')}}" class="btn btn-secondary"> لغو</a>
            </div>
            {{csrf_field()}}
        </form>
    </div>
    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
</x-app-layout>
