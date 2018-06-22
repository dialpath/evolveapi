<?php

namespace EvolveAPI\Models;
use EvolveAPI\EVCore;

/**
 * Class Order
 * @package EvolveAPI\Models
 */
class Order extends EVCore
{

    /**
     * Order constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get a list of orders.
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all()
    {
        return $this->send("orders")->orders;
    }


    /**
     * Get a single order
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $uuid)
    {
        return $this->send("orders/{$uuid}")->order;
    }


}