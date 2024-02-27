<?php

use App\Http\Core\Adapters\Theme;

return [
    // Main menu
    'main'  => [
        // Admins
        [
            'breadcrumb-title' => 'مدیران',
            'icon'             => [
                'svg'  => Theme::getSvgIcon("icons/duotune/general/gen049.svg", "svg-icon-2x"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ],
            'classes'          => ['item' => 'py-2'],
            'attributes'       => [
                "data-kt-menu-trigger"   => "{default:'click',lg:'hover'}",
                "data-kt-menu-placement" => "left-start",
            ],
            'can'              => 'admin',
            'sub'              => [
                'items' => [
                    [
                        'heading' => 'مدیران',
                    ],
                    [
                        'title'  => 'cpanel.admin_list',
                        'path'   => 'dashboard/admin',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'can'    => 'admin_list',
                    ],
                    [
                        'title'  => 'cpanel.role',
                        'path'   => 'dashboard/roles',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'can'    => 'role_list',
                    ],
                    [
                        'title'  => 'cpanel.permission',
                        'path'   => 'dashboard/permission',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'can'    => 'permission_list'
                    ],
                    [
                        'heading' => 'کاربران',
                        'can'     => ['user_list', 'driver_list']
                    ],
                    [
                        'title'  => 'cpanel.users',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'can'    => 'user_list',
                        'sub'    => [
                            'items' => [
                                [
                                    'title'  => 'cpanel.list',
                                    'path'   => 'dashboard/user',
                                    'bullet' => '<span class="bullet bullet-dot"></span>',
                                ],
                                [
                                    'title'  => 'cpanel.profile',
                                    'path'   => 'dashboard/user/profile',
                                    'bullet' => '<span class="bullet bullet-dot"></span>',
                                    'hide'   => true
                                ]
                            ]
                        ],
                    ]
                ],
            ],
        ],
    ],

    // Quick menu
    'quick' => [
        [
            'content' => 'cpanel.quick_actions',
            'classes' => ['item' => 'fs-6 text-dark fw-bold px-3 py-4']
        ],
        [
            'content' => '',
            'classes' => ['item' => 'separator mb-3 opacity-75']
        ],
        // Dashboard
        [
            'title' => 'auth.Log out',
            'path'  => '/logout'
        ],
    ],
];
