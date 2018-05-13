<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class Number
 * @package EvolveAPI\Models
 */
class Number extends EVCore
{
    /**
     * Number constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }


    /**
     * Get a list of assigned telephone numbers.
     * @param string $pbx The UUID of the PBX
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/numbers")->numbers;
    }

    /**
     * @param $pbx The UUID of the PBX
     * @param array $params
     *  number - The 10 Digit number to add
     *  description - The description of the TN
     *  recording - bool - Enable recording for this number?
     *  email - Enter an email address if you want email recordings emailed.
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create($pbx, array $params)
    {
        return $this->send("pbx/{$pbx}/numbers", 'POST', $params);
    }

    /**
     * Find and return an instance of a Number
     * @param $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find($pbx, $uuid)
    {
        return $this->send("pbx/{$pbx}/numbers/{$uuid}")->number;
    }

    /**
     * Update a DID with parameters used with the create method
     * @param $pbx
     * @param $uuid
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update($pbx, $uuid, array $params)
    {
        return $this->send("pbx/{$pbx}/numbers/$uuid", 'PUT', $params);
    }


    /**
     * Remove a number and its dial paths
     * @param $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete($pbx, $uuid)
    {
        return $this->send("pbx/{$pbx}/numbers/$uuid", 'DELETE');
    }

}