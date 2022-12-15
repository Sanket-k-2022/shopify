<?php

namespace Decimalone\Shopify;

class Collect
{
    private Shopify $api;

    public function __construct(Shopify $api)
    {
        $this->api = $api;
    }

    public function create($data=[])
    {
        $result = $this->api->run('post', 'collects', $data);
        return $result['collect'] ?? false;
    }

    public function list($product_id=null)
    {
        $result = $this->api->run('get', "collects");
        return $result['collects'] ?? false;
    }

    public function listByID($collect_id)
    {
        $params = get_defined_vars();
        return $this->api->run('get', "collects/$collect_id");
    }

    public function count($collection_id)
    {
        $result = $this->api->run('get', "collects/count", ['collection_id'=>$collection_id]);
        return $result['count'] ?? false;
    }

    public function remove($collect_id)
    {
        $params = get_defined_vars();
        return $this->api->run('delete', "collects/$collect_id");
    }
}
