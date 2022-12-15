<?php

namespace Decimalone\Shopify;

use GuzzleHttp\Exception\GuzzleException;
use Shopify\Exception\ApiException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class Shopify
{
    private $api_key;
    private $api_secret_key;
    private array $api_params;
    private mixed $api_version;
    private $shop;
    private $access_token;
    private $headers = [];
    public $errors;


    /**
     * @throws ApiException
     */
    public function __construct($shop, $api_key, $api_secret_key, $access_token, $api_version='2022-10',  array $api_params = [])
    {
        $this->shop = $shop;
        $this->api_key = $api_key;
        $this->api_secret_key = $api_secret_key;
        $this->api_params = $api_params;
        $this->api_version = $api_version;
        $this->access_token = $access_token;
        $this->headers = ['X-Shopify-Access-Token' => $access_token, 'Content-Type' => 'application/json' ];
    }

    public function methods()
    {
        $methods = ['get','post','put','delete'];
        return $methods;
    }
    public function run($method, $endpoint, $params=[], $iteration=0)
    {
        if(!in_array($method, $this->methods())) {
            throw new MethodNotAllowedException($this->methods(), 'method not allowed');
        }

        $url = "https://$this->shop.myshopify.com/admin/api/$this->api_version/$endpoint.json";
        $client  = new \GuzzleHttp\Client();
        $options['headers'] = $this->headers;
        if($params)
            $options['body'] = json_encode($params);
//        $url .= '?'. http_build_query($params);
//        dd($url);
        try {
            $http_response  = $client->request($method, $url, $options);
            $rate_limit = $http_response->getHeader('X-Shopify-Shop-Api-Call-Limit');
            if($rate_limit) {
                $rate_limit = $rate_limit[0];
            }

            if($rate_limit == '40/40' && $iteration <= 3) {
                $retry_after = (int)$http_response->getHeader('Retry-After');
                sleep($retry_after);
                $iteration += 1;
                $this->run($method, $endpoint, $appendby, $params, $iteration);
            }
            return json_decode($http_response->getBody()->getContents(),true);
        }
        catch (GuzzleException $e) {
            $this->errors = $e->getMessage();
            return false;
        }
    }


}
