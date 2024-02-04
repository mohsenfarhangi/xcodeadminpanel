<?php
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
