<?php

namespace Decimalone\Shopify;

class CustomCollection
{
    private Shopify $api;

    public function __construct(Shopify $api)
    {
        $this->api = $api;
    }

    public function create($data=[])
    {
        return $this->api->run('post', "custom_collections", $data);
    }

    public function list($product_id, $params=[])
    {
        return $this->api->run('post', "custom_collections/$product_id", $params);
    }

    public function single($custom_collection_id)
    {
        $params = get_defined_vars();
        return $this->api->run('post', "custom_collections/$custom_collection_id", $params);
    }

    public function count($product_id, $params = [])
    {
        return $this->api->run('post', "custom_collections/count", $params);
    }

    public function delete($custom_collection_id)
    {
        return $this->api->run('delete', "custom_collections/$custom_collection_id");
    }
}
