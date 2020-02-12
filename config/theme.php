<?php

$user_style='theme.cryptoadmin.user';
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

            'css' => [
                'default' => $user_style.'.layouts.css.default',
                'toast' => $user_style.'.layouts.css.toast'
                ],

            'js' => [
                'default' =>$user_style.'.layouts.js.default',
                'toast' => $user_style.'.layouts.js.toast',
            ],
        ]
    ];