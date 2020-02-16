<?php

$user_style='theme.cryptoadmin.user';
$admin_style = 'theme.cryptoadmin.admin';
$member_style = 'theme.cryptoadmin.member';
return [

        'user'=> [

            'view' => $user_style.'.',

            'user-app' => $user_style.'.layouts.user-app',
            'header' => $user_style.'.layouts.header',
            'header-login' => $user_style.'.layouts.header-login',
            'footer' => $user_style.'.layouts.footer',
            'sidebar' => $user_style.'.layouts.sidebar',

            'welcome' => $user_style.'.welcome',
            'header-notifications' => $user_style.'.layouts.header-notifications',
            'header-user-profiles' => $user_style.'.layouts.header-user-profiles',
             'errors' => $user_style.'.layouts.errors',
            'css' => [
                'default' => $user_style.'.layouts.css.default',
                'toast' => $user_style.'.layouts.css.toast'
            ],

            'js' => [
                'default' =>$user_style.'.layouts.js.default',
                'toast' => $user_style.'.layouts.js.toast',
            ],
        ],

        'admin' => [
            'tools' => [
                'guard-switcher'=> $admin_style.'.tools.guard-switcher'],

            'view' => $admin_style.'.',
            'admin-app' => $admin_style.'.layouts.admin-app',
            'header' => $admin_style.'.layouts.header',
            'header-login' => $admin_style.'.layouts.header-login',
            'footer' => $admin_style.'.layouts.footer',
            'sidebar' => $admin_style.'.layouts.sidebar',

            'welcome' => $admin_style.'.welcome',
            'header-notifications' => $admin_style.'.layouts.header-notifications',
            'header-admin-profiles' => $admin_style.'.layouts.header-admin-profiles',
            'errors' => $admin_style.'.layouts.errors',
            'css' => [
                'default' => $admin_style.'.layouts.css.default',
                'toast' => $admin_style.'.layouts.css.toast'
            ],

            'js' => [
                'default' =>$admin_style.'.layouts.js.default',
                'toast' => $admin_style.'.layouts.js.toast',
            ],
        ],

        'member'=> [

            'view' => $member_style.'.',
            'btn' => [
                'index' => [
                    'crud'=> $member_style.'.layouts.btn-index-crud',
                    'table_tr'=> $member_style.'.layouts.btn-index-table_tr',
                ],
                'edit' => [
                    'crud'=> $member_style.'.layouts.btn-edit-crud',
                ],
                'create' => [
                    'crud'=> $member_style.'.layouts.btn-create-crud',
                ]

            ],

            'member-app' => $member_style.'.layouts.member-app',
            'header' => $member_style.'.layouts.header',
            'header-login' => $member_style.'.layouts.header-login',
            'footer' => $member_style.'.layouts.footer',
            'sidebar' => $member_style.'.layouts.sidebar',

            'welcome' => $member_style.'.welcome',
            'header-notifications' => $member_style.'.layouts.header-notifications',
            'header-member-profiles' => $member_style.'.layouts.header-member-profiles',
            'errors' => $member_style.'.layouts.errors',
            'css' => [
                'default' => $member_style.'.layouts.css.default',
                'toast' => $member_style.'.layouts.css.toast'
                ],

            'js' => [
                'default' =>$member_style.'.layouts.js.default',
                'toast' => $member_style.'.layouts.js.toast',
            ],

        ]
    ];