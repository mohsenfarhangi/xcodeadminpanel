<?php

namespace App\Http\Core;


use App\Http\Controllers\Api\User;
use App\Http\Core\Adapters\Theme;
use App\Models\Configurations;
use App\Models\Drivers;
use App\Models\Invoices;
use App\Models\Orders;
use App\Models\ProductOrders;
use App\Models\Users;
use Carbon\Carbon;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class Util
{
    /**
     * create random unique number with postfix and prefix for driverCode
     * @param string $type // driver or user
     * @param $startFrom integer
     * @param $end integer
     * @param $prefix string
     * @param $postfix string
     * @return string
     */
    public static function createUniqueCode(string $type = "driver", int $startFrom = 10000000, int $end = 99999999, string $prefix = '', string $postfix = ''): string
    {
        $unique_code = $prefix . mt_rand($startFrom, $end) . $postfix;

        $last_id = 0;
        if ($type == 'driver') {
            $column      = 'driver_code';
            $model       = Drivers::query();
            $checkUnique = $model->where($column, '=', $unique_code)->first();
        }
        if ($type == 'user') {
            $column      = "user_code";
            $model       = Users::query();
            $checkUnique = $model->where($column, '=', $unique_code)->first();
        }
        if ($type == 'invoice') {
            $column      = 'transactionId';
            $model       = Invoices::query();
            $checkUnique = $model->where($column, '=', $unique_code)->first();
        }
        if ($type == 'order_id') {
            $column      = 'product_order_id';
            $model       = Invoices::query();
            $checkUnique = $model->where($column, '=', $unique_code)->first();
        }
        if ($type == 'order_code') {
            $column      = 'order_code';
            $model       = Orders::query();
            $checkUnique = $model->where($column, '=', $unique_code)->first();
        }
        if (!empty($checkUnique)) {
            return self::createUniqueCode($type);
        }
        return $unique_code;
    }

    /**
     *
     * @return string
     */
    public static function getCurrentSeason(): string
    {
        // get today's date
        $today = new DateTime();
// get the season dates
        $spring = new DateTime('March 20');
        $summer = new DateTime('June 20');
        $fall   = new DateTime('September 22');
        $winter = new DateTime('December 21');

        $season = '';
        switch (true) {
            case $today >= $spring && $today < $summer:
                $season = 'spring';
                break;

            case $today >= $summer && $today < $fall:
                $season = 'summer';
                break;

            case $today >= $fall && $today < $winter:
                $season = 'autumn';
                break;

            default:
                $season = 'winter';
        }
        return $season;
    }

    /**
     * @return string
     */
    public static function getDayOfWeekType(): string
    {
        $carbon = Carbon::now('Asia/Tehran');
        $carbon->startOfWeek(Carbon::SATURDAY);
        $carbon->endOfWeek(Carbon::FRIDAY);
        $type = 'middle_week';
        if ($carbon->isWeekend()) {
            $type = 'weekend';
        }
        return $type;
    }

    /**
     * sample [
     * [53.04686471372193,36.59581749189127],
     * [53.07643590785028,36.55336515991357]
     * ]
     *
     * @param $points
     * @return string
     */
    public function arrayPointsToGeoText($points): string
    {
        $data = [];
        foreach ($points as $point) {
            $data[] = implode(' ', $point);
        }

        return implode(',', $data);
    }

    public static function getCurrentDayChatrFormat($timestamp = null)
    {
        if (empty($timestamp)) {
            $timestamp = 'now';
        }
        $Carbon = new Carbon($timestamp);
        $day    = $Carbon->format('D');
        return substr($day, 0, 2);
    }

    /**
     * check table is joined in query
     * @param $query
     * @param $table
     * @return bool
     */
    public static function joined($query, $table): bool
    {
        $joins = $query->getQuery()->joins;
        if ($joins == null) {
            return false;
        }
        foreach ($joins as $join) {
            if ($join->table == $table) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $amount
     * @return string
     */
    public static function numberToWord($number): string
    {
        $numberToWord = new NumberToWord();
        return $numberToWord->numberToWords($number);
    }

    /**
     * @param Model $for must be drivers or users model
     * @param $amount
     * @param array $details
     * @param string $type
     * @return mixed
     * @throws \Exception
     */
    public static function chatrPayment(Model $for, $amount, $title, string $type = "out", array $details = [])
    {
        $invoice = new Invoice;
        $invoice->amount($amount);
        $invoice->detail($details);

        return Payment::callbackUrl(route('payment.callback'))->purchase($invoice, function ($driver, $transactionId) use ($invoice, $for, $title, $type) {

            $details = [];
            foreach ($invoice->getDetails() as $key => $detail) {
                $details[] = [
                    'meta_key'   => $key,
                    'meta_value' => $detail
                ];
            }

            $createInvoice = $for->invoices()->create([
                'uuid'             => $invoice->getUuid(),
                'title'            => $title,
                'amount'           => $invoice->getAmount(),
                'transactionId'    => $transactionId,
                'transaction_type' => $type,
                'via'              => $invoice->getDriver()
            ]);
            $createInvoice->metas()->createMany($details);
        })->
        pay()->toJson();
    }

    /**
     * @param $amount
     * @param bool $transactionId // if true create unique transaction id
     * @return Invoice
     * @throws \Exception
     */
    public static function invoice($amount, bool $transactionId = false): Invoice
    {
        $invoice = new Invoice();
        $invoice->amount((float)$amount);
        if ($transactionId) {
            $transId = self::createUniqueCode('invoice');
            $invoice->transactionId($transId);
        }
        return $invoice;
    }

    /**
     * @param $via
     * @return mixed|string
     */
    public static function getInvoiceVia($via)
    {
        $value = "";
        switch ($via) {
            case "inaxApi":
            case "gateway":
            case "zarinpal":
                $value = "gateway";
                break;
            default :
                $value = $via;
                break;
        }
        return $value;
    }

    /**
     * @param $status
     * @return string|string[]
     */
    public static function getInvoiceStatus($status = '')
    {
        $statuses = [
            0 => 'unpaid',
            1 => 'paid',
            2 => 'canceled'
        ];

        if ($status == "") {
            return $statuses;
        } else {
            return $statuses[$status];
        }
    }

    /**
     * @param $status
     * @return string|string[]
     */
    public static function getConfirmStatus($confirm = '')
    {
        $statuses = [
            0 => [
                'label' => __('cpanel.not confirmed'),
                'color' => 'danger'
            ],
            1 => [
                'label' => __('cpanel.pending'),
                'color' => 'warning'
            ],
            2 => [
                'label' => __('cpanel.confirmed'),
                'color' => 'success'
            ]
        ];

        if ($confirm == "") {
            return $statuses;
        } else {
            return $statuses[$confirm];
        }
    }

    /**
     * #format price number
     * @param $price
     * @param $unit
     * @return string
     */
    public static function priceFormat($price, $unit = ''): string
    {
        if (empty($price)) {
            $price = 0;
        }
        if (empty($unit)) {
            $unit = config('theme.general.general.price_unit', 'IRT');
        }
        $unitData = Data::getPriceUnits($unit);

        $price_format = number_format($price, $unitData['decimal'], $unitData['decimal_separator'], $unitData['thousand_separator']);

        $format = "";
        if ($unitData['position'] == 'before') {
            $format = "UNIT";
            if ($unitData['space']) {
                $format = $format . " ";
            }
            $format = $format . "PRICE";
        }

        if ($unitData['position'] == 'after') {
            $format = "PRICE";
            if ($unitData['space']) {
                $format .= " ";
            }
            $format .= "UNIT";
        }

        return str_replace(['UNIT', 'PRICE'], [$unitData['label'], $price_format], $format);
    }

    public static function geoToAddress($lng, $lat)
    {
        $client = new Client(['verify' => false]);

        $query = [
            'lat' => $lat,
            'lng' => $lng,
        ];

        $header = [
            'Api-Key'      => config('api.neshan.api_key'),
            'Content-Type' => 'application/json'
        ];

        $result = $client->request(
            'GET',
            config('api.neshan.reverse_api_url'),
            ['headers' => $header, 'query' => $query]
        );

        return json_decode($result->getBody(), true);
    }
}
