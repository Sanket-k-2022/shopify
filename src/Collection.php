<?php

namespace Decimalone\Shopify;

class Collection
{
    private Shopify $api;

    public function __construct(Shopify $api)
    {
        $this->api = $api;
    }

    public function single($collection_id)
    {
        return $this->api->run('get', "collections/$collection_id");
    }

    public function list($collection_id)
    {
        return $this->api->run('get', "collections/$collection_id/products");
    }
}
