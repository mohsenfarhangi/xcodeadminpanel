<?php

return [
    # Theme layout templates directory
    'KT_THEME_LAYOUT_DIR' => 'layout',

    //Product
    'product'    => array(
        'name'        => 'Chatr',
        'description' => 'Chatr',
        'version'     => '1.0.0',
        'preview'     => 'https://chatr.com/'
    ),

    'theme'  => [
        'logo'        => 'assets/media/chatr/logo/logo-chatr.png',
        'logo-mobile' => 'assets/media/chatr/logo/logo-chatr.png',
    ],

    // Meta
    'meta'   => array(
        'title'       => 'Chatr',
        'description' => 'Chatr',
        'keywords'    => 'Chatr',
        'canonical'   => '',
        'site-key'    => '6Lf92jMUAAAAANk8wz68r73rA2uPGr4_e0gn96BL',
    ),

    'general' => [
        'price_unit' => 'IRR'
    ],


    # Theme Assets
    'assets' => [
        'favicon'         => 'assets/media/logos/favicon.ico',
        'fonts'           => [
            'google' => [
                'Inter:300,400,500,600,700'
            ],
        ],
        'body'            => 'auth-bg bgi-size-cover bgi-position-center bgi-no-repeat',
        'auth_background' => [
            'light' => 'resources/assets/media/auth/bg4.jpg',
            'dark'  => 'resources/assets/media/auth/bg4-dark.jpg'
        ],
        'css'             => [
//            'assets/plugins/custom/prismjs/prismjs.bundle.rtl.css',
//            'assets/plugins/global/plugins.bundle.rtl.css',
        ],
        'js'              => [
            'resources/assets/js/app.js',
            'resources/assets/js/components.js',
//            'assets/js/widgets.bundle.js',
//            'assets/js/custom/global.js',
            'resources/assets/js/custom/pages/cpanel/controls.js',
        ],
    ],


    # Theme Vendors

    'vendors' => [
        'datatables'             => [
            'css' => [
                'assets/plugins/custom/datatables/datatables.bundle.css',
            ],
            'js'  => [
                'assets/plugins/custom/datatables/datatables.bundle.js',
            ],
        ],
        'formrepeater'           => [
            'js' => [
                'assets/plugins/custom/formrepeater/formrepeater.bundle.js',
            ],
        ]
    ],

    'layout' => [
        'main'  => array(
            'type' => 'default', // Set layout type: default|blank|none
        ),
        // Aside
        'aside' => array(
            'display'   => true, // Display aside
            'theme'     => 'dark', // Set aside theme(dark|light)
            'menu'      => 'main', // Set aside menu(main|documentation)
            'fixed'     => true,  // Enable aside fixed mode
            'minimized' => false, // Set aside minimized by default
            'minimize'  => true, // Allow aside minimize toggle
            'hoverable' => true, // Allow aside hovering when minimized
            'menu-icon' => 'svg' // Menu icon type(svg|font)
        ),
    ]

];
