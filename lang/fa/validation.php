<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute باید پذیرفته شده باشد.',
    'active_url'           => 'آدرس :attribute معتبر نیست.',
    'after'                => ':attribute باید تاریخی بعد از :date باشد.',
    'after_or_equal'       => ':attribute باید تاریخی بعد از :date، یا مطابق با آن باشد.',
    'alpha'                => ':attribute باید فقط حروف الفبا باشد.',
    'alpha_dash'           => ':attribute باید فقط حروف الفبا، اعداد، خط تیره و زیرخط باشد.',
    'alpha_num'            => ':attribute باید فقط حروف الفبا و اعداد باشد.',
    'array'                => ':attribute باید آرایه باشد.',
    'before'               => ':attribute باید تاریخی قبل از :date باشد.',
    'before_or_equal'      => ':attribute باید تاریخی قبل از :date، یا مطابق با آن باشد.',
    'between'              => [
        'numeric' => ':attribute باید بین :min و :max باشد.',
        'file'    => ':attribute باید بین :min و :max کیلوبایت باشد.',
        'string'  => ':attribute باید بین :min و :max کاراکتر باشد.',
        'array'   => ':attribute باید بین :min و :max آیتم باشد.',
    ],
    'boolean'              => ':attribute فقط می‌تواند true و یا false باشد.',
    'confirmed'            => ':attribute با تکرار مطابقت ندارد.',
    'date'                 => ':attribute یک تاریخ معتبر نیست.',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => ':attribute با الگوی :format مطابقت ندارد.',
    'different'            => ':attribute و :other باید از یکدیگر متفاوت باشند.',
    'digits'               => ':attribute باید :digits رقم باشد.',
    'digits_between'       => ':attribute باید بین :min و :max رقم باشد.',
    'dimensions'           => 'ابعاد تصویر :attribute قابل قبول نیست.',
    'distinct'             => ':attribute مقدار تکراری دارد.',
    'email'                => ':attribute باید یک قالب معتبر داشته باشد.',
    'exists'               => ':attribute انتخاب شده، معتبر نیست.',
    'file'                 => ':attribute باید یک فایل معتبر باشد.',
    'filled'               => ':attribute باید مقدار داشته باشد.',
    'gt'                   => [
        'numeric' => ':attribute باید بزرگتر از :value باشد.',
        'file'    => ':attribute باید بزرگتر از :value کیلوبایت باشد.',
        'string'  => ':attribute باید بیشتر از :value کاراکتر داشته باشد.',
        'array'   => ':attribute باید بیشتر از :value آیتم داشته باشد.',
    ],
    'gte'                  => [
        'numeric' => ':attribute باید بزرگتر یا مساوی :value باشد.',
        'file'    => ':attribute باید بزرگتر یا مساوی :value کیلوبایت باشد.',
        'string'  => ':attribute باید بیشتر یا مساوی :value کاراکتر داشته باشد.',
        'array'   => ':attribute باید بیشتر یا مساوی :value آیتم داشته باشد.',
    ],
    'image'                => ':attribute باید یک تصویر معتبر باشد.',
    'in'                   => ':attribute انتخاب شده، معتبر نیست.',
    'in_array'             => ':attribute در لیست :other وجود ندارد.',
    'integer'              => ':attribute باید عدد صحیح باشد.',
    'ip'                   => ':attribute باید آدرس IP معتبر باشد.',
    'ipv4'                 => ':attribute باید یک آدرس معتبر از نوع IPv4 باشد.',
    'ipv6'                 => ':attribute باید یک آدرس معتبر از نوع IPv6 باشد.',
    'json'                 => ':attribute باید یک رشته از نوع JSON باشد.',
    'lt'                   => [
        'numeric' => ':attribute باید کوچکتر از :value باشد.',
        'file'    => ':attribute باید کوچکتر از :value کیلوبایت باشد.',
        'string'  => ':attribute باید کمتر از :value کاراکتر داشته باشد.',
        'array'   => ':attribute باید کمتر از :value آیتم داشته باشد.',
    ],
    'lte'                  => [
        'numeric' => ':attribute باید کوچکتر یا مساوی :value باشد.',
        'file'    => ':attribute باید کوچکتر یا مساوی :value کیلوبایت باشد.',
        'string'  => ':attribute باید کمتر یا مساوی :value کاراکتر داشته باشد.',
        'array'   => ':attribute باید کمتر یا مساوی :value آیتم داشته باشد.',
    ],
    'max'                  => [
        'numeric' => ':attribute نباید بزرگتر از :max باشد.',
        'file'    => ':attribute نباید بزرگتر از :max کیلوبایت باشد.',
        'string'  => ':attribute نباید بیشتر از :max کاراکتر داشته باشد.',
        'array'   => ':attribute نباید بیشتر از :max آیتم داشته باشد.',
    ],
    'mimes'                => 'فرمت‌های معتبر فایل عبارتند از: :values.',
    'mimetypes'            => 'فرمت‌های معتبر فایل عبارتند از: :values.',
    'min'                  => [
        'numeric' => ':attribute نباید کوچکتر از :min باشد.',
        'file'    => ':attribute نباید کوچکتر از :min کیلوبایت باشد.',
        'string'  => ':attribute نباید کمتر از :min کاراکتر داشته باشد.',
        'array'   => ':attribute نباید کمتر از :min آیتم داشته باشد.',
    ],
    'not_in'               => ':attribute انتخاب شده، معتبر نیست.',
    'not_regex'            => 'فرمت :attribute معتبر نیست.',
    'numeric'              => ':attribute باید عدد یا رشته‌ای از اعداد باشد.',
    'present'              => ':attribute باید در پارامترهای ارسالی وجود داشته باشد.',
    'regex'                => 'فرمت :attribute معتبر نیست.',
    'required'             => ':attribute الزامی است.',
    'required_if'          => 'هنگامی که :other برابر با :value است، :attribute الزامی است.',
    'required_unless'      => ':attribute الزامی است، مگر آنکه :other در :values موجود باشد.',
    'required_with'        => 'در صورت وجود :values، :attribute نیز الزامی است.',
    'required_with_all'    => 'در صورت وجود فیلدهای :values، :attribute نیز الزامی است.',
    'required_without'     => 'در صورت عدم وجود :values، :attribute الزامی است.',
    'required_without_all' => 'در صورت عدم وجود هر یک از فیلدهای :values، :attribute الزامی است.',
    'same'                 => ':attribute و :other باید همانند هم باشند.',
    'size'                 => [
        'numeric' => ':attribute باید برابر با :size باشد.',
        'file'    => ':attribute باید برابر با :size کیلوبایت باشد.',
        'string'  => ':attribute باید برابر با :size کاراکتر باشد.',
        'array'   => ':attribute باید شامل :size آیتم باشد.',
    ],
    'starts_with'          => 'The :attribute must start with one of the following: :values',
    'string'               => ':attribute باید رشته باشد.',
    'timezone'             => ':attribute باید یک منطقه زمانی معتبر باشد.',
    'unique'               => ':attribute قبلا انتخاب شده است.',
    'uploaded'             => 'بارگذاری فایل :attribute موفقیت آمیز نبود.',
    'url'                  => ':attribute معتبر نمی‌باشد.',
    'uuid'                 => 'The :attribute must be a valid UUID.',

    'phone'  => ':attribute شماره ثابت معتبر نمیباشد.',
    'mobile' => ':attribute شماره همراه معتبر نمیباشد.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name'                     => 'نام',
        'first_name'               => 'نام',
        'last_name'                => 'نام خانوادگی',
        'password'                 => 'رمز عبور',
        'password_confirm'         => 'تکرار رمز عبور',
        'gender'                   => 'جنسیت',
        'active'                   => 'وضعیت',
        'national_id'              => 'کد ملی',
        'user_infos.national_code' => 'کد ملی',
        'id_no'                    => 'شماره شناسنامه',
        'title'                    => 'عنوان',
        'abstract'                 => 'متن کوتاه',
        'context'                  => 'متن اصلی',
        'image_id'                 => 'تصویر',
        'city_id'                  => 'شهر',
        'province_id'              => 'استان',
        'region_id'                => 'منطقه',
        'phone'                    => 'تلفن ثابت',
        'mobile'                   => 'تلفن همراه',
        'mobile_no'                => 'تلفن همراه',
        'fax'                      => 'نمابر',
        'email'                    => 'پست الکترونیک',
        'address'                  => 'آدرس',
        'code'                     => 'کد',
        'title_fa'                 => 'عنوان فارسی',
        'rank_order'               => 'مرتبه',
        'number'                   => 'شماره',
        'day'                      => 'روز',
        'start_time'               => 'زمان شروع',
        'end_time'                 => 'زمان پایان',
        'month'                    => 'ماه',
        'year'                     => 'سال',
        'hour'                     => 'ساعت',
        'minute'                   => 'دقیقه',
        'second'                   => 'ثانیه',
        'date'                     => 'تاریخ',
        'time'                     => 'زمان',
        'size'                     => 'اندازه',
        'national code'            => 'کد ملی',
        'national_code'            => 'کد ملی',
        'otp_token'                => 'کد یکبارمصرف',
        'comment'                  => 'نظر',
        'step'                     => 'مرحله',
        'description'              => 'توضیحات',
        'region'                   => 'ناحیه',
        'lat'                      => 'طول جغرافیایی',
        'lng'                      => 'عرض جغرافیایی',
        'images'                   => 'تصاویر',
        'accept_privacy'           => 'پذیرفتن قوانین',
        'bill_type'                => 'نوع قبض',
        'operator'                 => 'اپراتور',
        'bill_id'                  => 'شناسه قبض',
        'participate_code'         => 'کد اشتراک کنتور گاز',
        'order_id'                 => 'شماره تراکنش',
        'pay_id'                   => 'شماره پرداخت',
        'product_id'               => 'آیدی محصول',
        'pay_type'                 => 'نحوه پرداخت تراکنش',
        'internet_type'            => 'نوع بسته اینترنت',
        'ref_code'                 => 'شماره پیگیری تراکنش موفق',
        'role_id'                  => 'نقش کاربری',
        'status'                   => 'وضعیت',
        'price'                    => 'قیمت',
        'amount'                   => 'مقدار',
        'amount_unit'              => 'واحد مقدار',
        'license_code'             => 'شماره گواهینامه',
        'vehicle_name'             => 'نام ماشین',
        'plaque'                   => 'پلاک',
        'user_id'                  => 'نام کاربری',
        'shift_work_id'            => 'شیفت کاری',
        'geo_location_lat'         => 'طول جغرافیایی',
        'geo_location_lng'         => 'عرض جغرافیایی',
        'chatr_order_items_form.*.recycle_item_id'          => 'اقلام بازیافتی',
        'chatr_order_items_form.*.recycle_item_amount'      => 'مقدار اقلام بازیافتی',
        'chatr_order_items_form.*.recycle_item_price'       => 'قیمت اقلام بازیافتی',
        'chatr_order_steps_form.*.step_date'                => 'تاریخ ثبت مراحل',
        'chatr_order_steps_form.*.step_id'                  => 'مرحله درخواست',
    ],
];
