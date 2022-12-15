<?php

namespace Decimalone\Shopify;

class Product
{
    private Shopify $api;

    public function __construct(Shopify $api)
    {
        $this->api = $api;
    }

    public function getProductByID($product_id)
    {
        return $this->api->run('get', "products/$product_id");
    }

    public function countProducts()
    {
        return $this->api->run('get', 'products/count')['count'];
    }

    public function updateProductByID($product_id, $params=[])
    {
        return $this->api->run('put', "products/$product_id", $params);
    }

    public function deleteProductByID($product_id, $params=[])
    {
        return $this->api->run('delete', "products/$product_id", $params);
    }

    public function access_scopes()
    {
        return $this->api->run('get', 'oauth/access_scopes');
    }
}