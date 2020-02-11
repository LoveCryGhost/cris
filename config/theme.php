<?php

$user_style='theme.cryptoadmin.user';
return [
        'user'=> [
            'user-app' => $user_style.'.layouts.user-app',
            'header' => $user_style.'.layouts.header',
            'header-login' => $user_style.'.layouts.header-login',
            'footer' => $user_style.'.layouts.footer',
            'sidebar' => $user_style.'.layouts.sidebar',
            'css' => $user_style.'.layouts.css',
            'js' => $user_style.'.layouts.js',

            'welcome' => $user_style.'.welcome',
            'header-notifications' => $user_style.'.layouts.header-notifications',
            'header-user-profiles' => $user_style.'.layouts.header-user-profiles',
        ]
    ];