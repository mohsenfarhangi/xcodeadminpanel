<?php
if (!function_exists('getGregorianDate')) {
    function getGregorianDate($date, $format = 'Y-m-d')
    {
        if ($date != "" || $date != null) {
            $date = str_replace("/", "-", numberToEnglish($date));
            return \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat('Y-m-d', $date)->format($format);
        }

        return '';
    }
}

if (!function_exists('getJalaliDate')) {
    function getJalaliDate($date, $format = 'Y-m-d')
    {
        if ($date != "" || $date != null) {
            $date = str_replace("/", "-", numberToEnglish($date));
            return \Morilog\Jalali\CalendarUtils::strftime($format, $date);
        }

        return null;
    }
}

if (!function_exists('numberToPersian')) {
    function numberToPersian($srtDigit = '-')
    {
        $digitEN      = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $digitPersian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

        return str_replace($digitEN, $digitPersian, $srtDigit);
    }
}

if (!function_exists('numberToEnglish')) {
    function numberToEnglish($srtDigit = '-')
    {
        $digitEN      = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $digitPersian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

        return str_replace($digitPersian, $digitEN, $srtDigit);
    }
}

if (!function_exists('getTimePostfix')) {
    function getTimePostfix($time = '')
    {
        switch ($time) {
            case 12:
                return '12 ' . __('cpanel.noon');

            case 13:
                return '1 ' . __('cpanel.noon');

            case 14:
                return '2 ' . __('cpanel.noon');

            case 15:
                return '3 ' . __('cpanel.Evening');

            case 16:
                return '4 ' . __('cpanel.Evening');

            case 17:
                return '5 ' . __('cpanel.Evening');

            case 18:
                return '6 ' . __('cpanel.Evening');

            case 19:
                return '7 ' . __('cpanel.night');

            case 20:
                return '8 ' . __('cpanel.night');

            case 21:
                return '9 ' . __('cpanel.night');

            case 22:
                return '10 ' . __('cpanel.night');

            case 23:
                return '11 ' . __('cpanel.night');

            case 24:
                return '12 ' . __('cpanel.night');

            case 1:
                return '1 ' . __('cpanel.night');

            case 2:
                return '2 ' . __('cpanel.night');

            case 3:
                return '3 ' . __('cpanel.night');

            case 4:
                return '4 ' . __('cpanel.Morning');

            case 5:
                return '5 ' . __('cpanel.Morning');

            case 6:
                return '6 ' . __('cpanel.Morning');

            case 7:
                return '7 ' . __('cpanel.Morning');

            case 8:
                return '8 ' . __('cpanel.Morning');

            case 9:
                return '9 ' . __('cpanel.Morning');

            case 10:
                return '10 ' . __('cpanel.Morning');

            case 11:
                return '11 ' . __('cpanel.Morning');
        }

        return '';
    }
}


if (!function_exists('getOption')) {
    /**
     * get application configuration
     *
     * @param $optionKey
     * @param $default
     * @return bool
     */
    function getOption($optionKey = '', $default = '')
    {
        $option = \App\Models\Configurations::getOption($optionKey);
        if (!$option) {
            return $default;
        }
        return $option;
    }
}

if (!function_exists('getUserStatuses')) {
    function getUserStatuses($status = "")
    {
        return \App\Http\Core\Data::getUsersStatus($status);
    }
}

if (!function_exists('getMediaUrl')) {
    /**
     * return media url
     * @param $audience
     * @return array[]
     */
    function getMediaUrl($filePath = '', $disk_name = 'public')
    {
        if (empty($filePath) || !Storage::disk($disk_name)->fileExists('media/' . $filePath)) {
            return asset('assets/media/avatars/blank.png');
        }
        return asset('storage/media/' . $filePath);
    }
}

if (!function_exists('getUserImage')) {
    /**
     * return media url
     * @param $audience
     * @return string
     */
    function getUserImage($filePath = '', $disk_name = 'public')
    {
        if (empty($filePath) || !(Storage::disk($disk_name)->fileExists('packages/' . $filePath))) {
            return asset('assets/media/avatars/blank.png');
        }
        return asset('storage/packages/' . $filePath);
    }
}
if (!function_exists('getProfileImagesUrl')) {
    /**
     * return media url
     * @param $audience
     * @return string
     */
    function getProfileImagesUrl($filePath = '', $disk_name = 'public')
    {
        if (empty($filePath) || !(Storage::disk($disk_name)->fileExists('packages/' . $filePath))) {
            return asset('assets/media/chatr/placeholder-image.jpg');
        }
        return asset('storage/packages/' . $filePath);
    }
}


if (!function_exists('jalaliDate')) {
    function jalaliWithFormat($format, $timestamp = 'now', $convert = true)
    {
        $date = \Morilog\Jalali\CalendarUtils::strftime($format, strtotime($timestamp));
        if ($convert) {
            return \Morilog\Jalali\CalendarUtils::convertNumbers($date);
        }
        return $date;
    }
}

if (!function_exists('jalaliToMiladi')) {
    function jalaliToMiladi($date, $from_format, $to_format = '')
    {
        $latinDate = \Morilog\Jalali\CalendarUtils::convertNumbers($date, true);
        $carbon    = \Morilog\Jalali\Jalalian::fromFormat($from_format, $latinDate)->toCarbon();

        if (empty($to_format)) {
            $to_format = $from_format;
        }
        return $carbon->format($to_format);
    }
}

