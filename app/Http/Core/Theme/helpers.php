<?php

use App\Http\Core\Adapters\Theme;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;

if (!function_exists('get_svg_icon')) {
    function get_svg_icon($path, $class = null, $svgClass = null)
    {
        $file_path = public_path(theme()->getMediaUrlPath() . $path);

        if (!file_exists($file_path)) {
            return '';
        }

        $svg_content = file_get_contents($file_path);

        $dom = new DOMDocument();
        $dom->loadXML($svg_content);

        // remove unwanted comments
        $xpath = new DOMXPath($dom);
        foreach ($xpath->query('//comment()') as $comment) {
            $comment->parentNode->removeChild($comment);
        }

        // add class to svg
        if (!empty($svgClass)) {
            foreach ($dom->getElementsByTagName('svg') as $element) {
                $element->setAttribute('class', $svgClass);
            }
        }

        // remove unwanted tags
        $title = $dom->getElementsByTagName('title');
        if ($title['length']) {
            $dom->documentElement->removeChild($title[0]);
        }
        $desc = $dom->getElementsByTagName('desc');
        if ($desc['length']) {
            $dom->documentElement->removeChild($desc[0]);
        }
        $defs = $dom->getElementsByTagName('defs');
        if ($defs['length']) {
            $dom->documentElement->removeChild($defs[0]);
        }

        // remove unwanted id attribute in g tag
        $g = $dom->getElementsByTagName('g');
        foreach ($g as $el) {
            $el->removeAttribute('id');
        }
        $mask = $dom->getElementsByTagName('mask');
        foreach ($mask as $el) {
            $el->removeAttribute('id');
        }
        $rect = $dom->getElementsByTagName('rect');
        foreach ($rect as $el) {
            $el->removeAttribute('id');
        }
        $xpath = $dom->getElementsByTagName('path');
        foreach ($xpath as $el) {
            $el->removeAttribute('id');
        }
        $circle = $dom->getElementsByTagName('circle');
        foreach ($circle as $el) {
            $el->removeAttribute('id');
        }
        $use = $dom->getElementsByTagName('use');
        foreach ($use as $el) {
            $el->removeAttribute('id');
        }
        $polygon = $dom->getElementsByTagName('polygon');
        foreach ($polygon as $el) {
            $el->removeAttribute('id');
        }
        $ellipse = $dom->getElementsByTagName('ellipse');
        foreach ($ellipse as $el) {
            $el->removeAttribute('id');
        }

        $string = $dom->saveXML($dom->documentElement);

        // remove empty lines
        $string = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $string);

        $cls = array('svg-icon');

        if (!empty($class)) {
            $cls = array_merge($cls, explode(' ', $class));
        }

        $asd = explode('/media/', $path);
        if (isset($asd[1])) {
            $path = 'assets/media/' . $asd[1];
        }

        $output = "<!--begin::Svg Icon | path: $path-->\n";
        $output .= '<span class="' . implode(' ', $cls) . '">' . $string . '</span>';
        $output .= "\n<!--end::Svg Icon-->";

        return $output;
    }
}

if (!function_exists('theme')) {
    /**
     * Get the instance of Theme class core
     *
     * @return Theme|Application|mixed
     */
    function theme()
    {
        return app(Theme::class);
    }
}

if (!function_exists('util')) {
    /**
     * Get the instance of Util class core
     *
     * @return Util|Application|mixed
     */
    function util()
    {
        return app(Util::class);
    }
}

if (!function_exists('assetIfHasRTL')) {
    /**
     * Get the asset path of RTL if this is an RTL request
     *
     * @param $path
     * @param null $secure
     *
     * @return string
     */
    function assetIfHasRTL($path, $secure = null)
    {
        if (isRTL()) {
            return asset(dirname($path) . '/' . basename($path, '.css') . '.rtl.css');
        }

        return asset($path, $secure);
    }
}

if (!function_exists('isRTL')) {
    /**
     * Check if the request has RTL param
     *
     * @return bool
     */
    function isRTL()
    {
        return (bool)request()->input('rtl');
    }
}

if (!function_exists('createPlaceCode')) {
    /**
     * Check if the request has RTL param
     *
     * @param $optionKey
     * @param $default
     * @return bool
     */
    function createPlaceCode()
    {
        $digits     = '123456789';
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $digitLength     = strlen($digits);
        $characterLength = strlen($characters);

        $randomString = [];
        while (count($randomString) != 2) {
            $new = $characters[rand(0, $characterLength - 1)];
            if (!in_array($new, $randomString))
                $randomString[] = $new;
        }

        while (count($randomString) != 8) {
            $new = $digits[rand(0, $digitLength - 1)];
            if (!in_array($new, $randomString))
                $randomString[] = $new;
        }

        return join('', $randomString);
    }
}

if (!function_exists('createMarketerCode')) {
    function createMarketerCode()
    {
        $digits     = '123456789';
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $digitLength     = strlen($digits);
        $characterLength = strlen($characters);

        $randomString = [];
        while (count($randomString) != 2) {
            $new = $characters[rand(0, $characterLength - 1)];
            if (!in_array($new, $randomString))
                $randomString[] = $new;
        }

        while (count($randomString) != 6) {
            $new = $digits[rand(0, $digitLength - 1)];
            if (!in_array($new, $randomString))
                $randomString[] = $new;
        }

        $code = join('', $randomString);
        $data = \App\Models\Marketer::where('referral_code', $code)->first();

        if ($data) createMarketerCode();
        return $code;
    }
}

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
