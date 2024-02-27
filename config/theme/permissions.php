<?php
return [
    'sections'    => [
        'admin'            => 'cpanel.admins',
        'role'             => 'cpanel.role',
        'permission'       => 'cpanel.permission',
        'user'             => 'cpanel.users'
    ],
    'permissions' => [
        'admin'            => [
            'list'   => 'cpanel.list',
            'create' => 'cpanel.create',
            'update' => 'cpanel.edit',
            'delete' => 'cpanel.delete',
            'import' => 'cpanel.import',
            'export' => 'cpanel.export'
        ],
        'role'             => [
            'list'   => 'cpanel.list',
            'create' => 'cpanel.create',
            'update' => 'cpanel.edit',
            'delete' => 'cpanel.delete',
            'import' => 'cpanel.import',
            'export' => 'cpanel.export'
        ],
        'permission'       => [
            'list'   => 'cpanel.list',
            'create' => 'cpanel.create',
            'update' => 'cpanel.edit',
            'delete' => 'cpanel.delete',
            'import' => 'cpanel.import',
            'export' => 'cpanel.export'
        ],
        'user'             => [
            'list'                  => 'cpanel.list',
            'create'                => 'cpanel.create',
            'update'                => 'cpanel.edit',
            'delete'                => 'cpanel.delete',
            'import'                => 'cpanel.import',
            'export'                => 'cpanel.export',
            'profile'               => 'cpanel.profile',
            'profile_overview'      => 'cpanel.Account Overview',
            'profile_change_avatar' => 'cpanel.change avatar',
            'profile_remove_avatar' => 'cpanel.remove avatar',
            'profile_edit'          => 'cpanel.Edit Accounts',
            'profile_address'       => 'cpanel.address',
            'profile_address_edit'  => 'cpanel.Edit address',
        ]
    ]
];
