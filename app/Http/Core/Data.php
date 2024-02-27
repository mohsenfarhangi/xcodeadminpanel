<?php

namespace App\Http\Core;

class Data
{
    /**
     * Users, drivers and admins statuses
     * @param string $status
     * @return array
     */
    public static function getUsersStatus(string $status = ''): array
    {
        $statuses = [
            'deleted' => [
                'label'   => __('cpanel.deleted'),
                'state'   => 'danger',
                'default' => false
            ],
            'inactive'  => [
                'label'   => __('cpanel.inactive'),
                'state'   => 'muted',
                'default' => false
            ],
            'active'  => [
                'label'   => __('cpanel.active'),
                'state'   => 'success',
                'default' => true
            ],
            'suspended'  => [
                'label'   => __('cpanel.suspended'),
                'state'   => 'warning',
                'default' => false
            ],
            'block'  => [
                'label'   => __('cpanel.block'),
                'state'   => '.text-white-50',
                'default' => false
            ],
            'pending'  => [
                'label'   => __('cpanel.pending'),
                'state'   => '.text-white-50',
                'default' => false
            ]
        ];

        if ($status != '') {
            return $statuses[$status];
        }
        return $statuses;
    }

    /**
     * price unit data
     * @param $unit
     * @return array|array[]
     */
    public static function getPriceUnits($unit)
    {
        $units = [
            'IRR' => [
                'label'              => 'ریال',
                'position'           => 'after',
                'space'              => true,
                'decimal_separator'  => '',
                'decimal'            => 0,
                'thousand_separator' => ',',
            ],
            'IRT' => [
                'label'              => 'تومان',
                'position'           => 'after',
                'space'              => true,
                'decimal_separator'  => '',
                'decimal'            => 0,
                'thousand_separator' => ',',
            ],
        ];
        if (!empty($unit)) {
            return $units[$unit];
        }
        return $units;
    }
}

