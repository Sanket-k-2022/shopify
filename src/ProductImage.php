<?php

namespace Decimalone\Shopify;

class ProductImage
{
    private Shopify $api;

    public function __construct(Shopify $api)
    {
        $this->api = $api;
    }

    public function create($product_id, $params = [])
    {
        return $this->api->run('post', "products/$product_id/images", $params);
    }

    public function list($product_id, $params=[])
    {
        return $this->api->run('get', "products/$product_id/images");
    }

    public function single($product_id, $image_id, $params=[])
    {
        return $this->api->run('get', "products/$product_id/images/$image_id",$params);
    }

    public function count($product_id, $params=[])
    {
        return $this->api->run('get', "products/$product_id/images/count",$params);
    }

    public function modify($image_id, $product_id, $params=[])
    {
        return $this->api->run('put', "products/$product_id/images/$image_id",$params);
    }

    public function delete($image_id, $product_id, $params=[])
    {
        return $this->api->run('delete', "products/$product_id/images/$image_id",$params);
    }
}