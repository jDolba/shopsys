<?php

namespace Shopsys\FrameworkBundle\Component\Client\Microservice;

use GuzzleHttp;

class Client
{
    private $microservice;

    public function call() {

        $guzzle = new GuzzleHttp\Client();
        $res = $guzzle->get('http://microservice-product-search:8000/1/product-ids',
            ['query' => 'ab']
        );
        $resultCode =  $res->getStatusCode();
        d($resultCode);
        /*$jsonData = \GuzzleHttp\json_encode($data);

        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CUSTOM_G, $jsonData);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData))
        );
        curl_setopt($curl_handle, CURLOPT_URL,'http://microservice-search:35730/en/service/search');
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
        $content = curl_exec($curl_handle);
        $error =  curl_error($curl_handle);
        $header = curl_getinfo( $curl_handle );
        curl_close($curl_handle);

        d($header);
        d($content);
        d($error);*/
    }
}