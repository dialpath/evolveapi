<?php
/**
 * Created by PhpStorm.
 * User: cdc
 * Date: 25-Jun-18
 * Time: 4:55 PM
 */

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

class Service extends EVCore
{
    /**
     * Order constructor.
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

    public function getPrices(){
        return $this->send("services/prices")->price_list;
    }
}