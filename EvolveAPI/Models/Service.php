<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class Service
 * @package EvolveAPI\Models
 */
class Service extends EVCore
{
    /**
     * Service constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get a list of services.
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all()
    {
        return $this->send("services")->services;
    }

    /**
     * Get a price deck for your account
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function getPrices()
    {
        return $this->send("services/prices")->price_list;
    }
}