<?php

namespace App\Handlers;

use Carbon\Carbon;

class UrlHandler
{
    public function shopee_url($url){
        //分析url https://shopee.com.my/Health-Beauty-cat.129?page=1&sortBy=sales
        //國家
        //page
        //sortBy

        $params =[];
        $url = str_replace('http://',"", $url);
        $url = str_replace('https://','', $url);
        $url = str_replace('https://','', $url);

        $url_paths = explode("?",$url);

        $params['url'] = $url_paths[0];
        $params['get_path'] = $url_paths[1];

        //Shopee網址
        $params['shopee'] = explode('/',$params['url'] )[0];

        //local
        switch ($shopee_url = $params['shopee']){
            case "shopee.com.my":
                $params['local'] = 'my';
                break;
            default;
                $params['local'] = null;
                break;
        }

        //cat
        $params['cat'] = explode("-cat.",explode('/',$params['url'])[1])[1];

        //抓出Get的變數
        $url_gets= explode("&",$url_paths[1]);

        foreach ($url_gets as $url_get){
            $url_get_arr =explode("=",$url_get);
            $params['gets'][$url_get_arr[0]]  = $url_get_arr[1];
        }
        return $params;
    }
}