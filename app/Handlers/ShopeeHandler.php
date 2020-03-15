<?php

namespace App\Handlers;

use GuzzleHttp\Client;

class ShopeeHandler
{
    public function ClientHeader_Shopee($url){
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'x-api-source' => 'pc',
            ]
        ]);
        while($response->getStatusCode()!=200){
            $response = $client->request('GET', $url, [
                'headers' => [
                    'x-api-source' => 'pc',
                ]
            ]);
        }
        return $response;
    }

    public function shopee_url($url){

        $params = (new StringHandler())->url($url);

        //Shopee網址

        //local
        switch ($shopee_url = $params['domain']){
            case "shopee.tw":
                $params['local'] = 'tw';
                break;

            case "shopee.co.id":
                $params['local'] = 'id';
                break;

            case "shopee.co.th":
                $params['local'] = 'th';
                break;

            case "shopee.com.my":
                $params['local'] = 'my';
                break;
            default;
                $params['local'] = null;
                break;
        }

        //cat
        $cat = explode("-cat.",explode('/',$params['website'])[1]);
        if(count($cat)==2){
            //是否有sub cat
            $sub_cat = explode('.', $cat[1]);
            if(count($sub_cat)==2){
                $params['cat'] = $sub_cat[1];
            }else{
                $params['cat'] = $cat[1];
            }
        }

        return $params;
    }
}
