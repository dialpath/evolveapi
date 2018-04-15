<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class Carrier - PRIVATE ENV ONLY
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
     * Get carrier object and return information pertaining to that carrier.
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find($uuid)
    {
        return $this->send("carriers/{$uuid}")->carrier;
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

    /**
     * Update a carrier configuration using the same fields as above.
     * @param $uuid
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update($uuid, array $params)
    {
        return $this->send("carriers/{$uuid}", 'PUT', $params);
    }

    /**
     * Remove a carrier and its routing profiles and any associated
     * outbound regex.
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete($uuid)
    {
       return $this->send("carriers/{$uuid}", 'DELETE');
    }

}