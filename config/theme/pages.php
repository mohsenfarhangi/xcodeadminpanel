<?php
return [
    'dashboard' => [
        'title'       => 'cpanel.dashboard',
        'description' => '',
        'view'        => 'index',
        'layout'      => array(
            'page-title' => array(
                'breadcrumb' => false // hide breadcrumb
            ),
        ),
        'admin'       => [
            'title'  => 'لیست کاربران',
            'view'   => 'index',
            'layout' => [
                'page-title' => [
                    'breadcrumb' => true
                ]
            ],
            'assets' => [
                'custom' => [
                    'js'  => [
                        'assets/plugins/custom/datatables/datatables.bundle.js',
                        'assets/js/custom/pages/cpanel/admins/controls.js',
                        'assets/js/custom/pages/cpanel/admins/index.js',
                    ],
                    'css' => [
                        'assets/plugins/custom/datatables/datatables.bundle.rtl.css',
                    ]
                ],
            ],
        ],
        'roles'       => [
            'title'  => 'نقش کاربری',
            'view'   => 'index',
            'layout' => [
                'page-title' => [
                    'breadcrumb' => true
                ]
            ],
            'assets' => [
                'custom' => [
                    'js'  => [
                        'assets/plugins/custom/datatables/datatables.bundle.js',
                        'assets/js/custom/pages/cpanel/roles/controls.js',
                        'assets/js/custom/pages/cpanel/roles/index.js',
                    ],
                    'css' => [
                        'assets/plugins/custom/datatables/datatables.bundle.rtl.css',
                    ]
                ],
            ],
        ],
        'permission'  => [
            'title'  => 'مجوز ها',
            'view'   => 'index',
            'layout' => [
                'page-title' => [
                    'breadcrumb' => true
                ]
            ],
            'assets' => [
                'custom' => [
                    'js'  => [
                        'assets/plugins/custom/datatables/datatables.bundle.js',
                        'assets/js/custom/pages/cpanel/permission/controls.js',
                        'assets/js/custom/pages/cpanel/permission/index.js',
                    ],
                    'css' => [
                        'assets/plugins/custom/datatables/datatables.bundle.rtl.css',
                    ]
                ],
            ],
        ],
        'user'        => [
            'title'   => 'لیست کاربران',
            'view'    => 'index',
            'layout'  => [
                'page-title' => [
                    'breadcrumb' => true
                ]
            ],
            'assets'  => [
                'custom' => [
                    'js'  => [
                        'assets/plugins/custom/datatables/datatables.bundle.js',
                        'assets/js/custom/pages/cpanel/user/controls.js',
                        'assets/js/custom/pages/cpanel/user/index.js',
                    ],
                    'css' => [
                        'assets/plugins/custom/datatables/datatables.bundle.rtl.css',
                    ]
                ],
            ],
            'profile' => [
                'title'  => 'پروفایل کاربر',
                'layout' => [
                    'page-title' => [
                        'breadcrumb' => true
                    ]
                ],
                'assets' => [
                    'custom' => [
                        'js'  => [
                            'assets/plugins/custom/datatables/datatables.bundle.js',
                            'assets/plugins/custom/leaflet/leaflet.bundle.js',
                            'assets/plugins/custom/formrepeater/formrepeater.bundle.js',
                            'assets/plugins/custom/fslightbox/fslightbox.bundle.js',
                            'assets/js/custom/pages/cpanel/user-profile/index.js'
                        ],
                        'css' => [
                            'assets/plugins/custom/datatables/datatables.bundle.rtl.css',
                            'assets/plugins/custom/leaflet/leaflet.bundle.css',
                        ]
                    ],
                ],
            ]
        ]
    ],
    'login'     => [
        'meta'   => [
            'title' => 'ورود'
        ],
        'assets' => [
            'custom' => [
                'css' => [
                    'resources/assets/plugins/formvalidation/dist/css/formValidation.css'
                ],
                'js'  => [
                    'resources/assets/plugins/formvalidation/dist/js/FormValidation.full.js',
                    'resources/assets/plugins/formvalidation/dist/js/plugins/Bootstrap5.js',
                    'resources/assets/js/custom/authentication/sign-in/general.js'
                ]
            ],
        ],
    ],
];
