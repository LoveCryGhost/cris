<?php

namespace App\Handlers;


class StringHandler
{
    public function url($url, $options=[]){
        //分析url https://shopee.com.my/Health-Beauty-cat.129?page=1&sortBy=sales
        //國家
        //page
        //sortBy

        $params =[];
        $url = str_replace('http://',"", $url);
        $url = str_replace('https://','', $url);
        $url = str_replace('https://','', $url);

        $url_paths = explode("?",$url);
        //抓出Get的變數
        $url_gets= explode("&",$url_paths[1]);

        foreach ($url_gets as $url_get){
            $url_get_arr =explode("=",$url_get);
            $params['gets'][$url_get_arr[0]]  = $url_get_arr[1];
        }
        $params['url'] = $url;
        $params['website'] = $url_paths[0];

        $domains = explode("/",$url_paths[0]);
        if(count($domains)>=2){
            $params['domain'] = $domains[0];
        }else{
            $params['domain'] = $url_paths;
        }
        $params['get_path'] = $url_paths[1];

        return $params;
    }
}
