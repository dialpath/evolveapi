<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class Carrier
 *
 * For private enviornments, this class will allow you to set
 * your carrier connections and modify them at any time. For
 * DialPath managed environments these features will be disabled. Obviously.
 *
 * @package EvolveAPI\Models
 */
class Carrier extends EVCore
{

    /**
     * Carrier constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of all carriers assigned to the environment.
     */
    public function all()
    {
        return $this->send("carriers")->carriers;
    }

    /**
     * Create a new carrier to pass calls to and from.
     * @param array $params Array keys and values below.
     *  name : string : The name of the carrier. i.e. Vitliety, Twilio, etc.
     *  peer : string : The pbx peer identifier. Small description like carrier-vitel or bw-one
     *    ip : string : The IP hostname of the carrier. For multiple IPs enter multiple carriers.
     *
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(array $params)
    {
        return $this->send("carriers", "POST", $params);
    }

}