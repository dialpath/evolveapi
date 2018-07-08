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
     * Create a number in your PBX.
     * ** NOTE THIS IS ONLY AVAILABLE IN SANDBOX/TESTING AND PRIVATE ENVIRONMENTS **
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
     * Remove a number and its dial paths - Production environments will issue a disconnect order
     * and will not be immediately reviewed until verified by DialPath support and confirmed by the owner.
     * ** THIS IS ONLY AVAILABLE IN SANDBOX AND PRIVATE ENVIRONMENTS **
     * @param $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete($pbx, $uuid)
    {
        return $this->send("pbx/{$pbx}/numbers/$uuid", 'DELETE');
    }


    /**
     * Assign a number to a registered e911 location.
     * @param $pbx
     * @param $uuid
     * @param $locationUuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function assignLocation($pbx, $uuid, $locationUuid)
    {
        return $this->send("pbx/{$pbx}/numbers/$uuid/e911", 'POST', [
            'location' => $locationUuid
        ]);
    }

    /**
     * Find all available local numbers by two letter state code.
     * @param string $pbx
     * @param string $state
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function findAvailableLocal(string $pbx, string $state)
    {
        return $this->send("pbx/{$pbx}/numbers/local", 'POST', [
            'state' => $state
        ])->numbers;
    }

    /**
     * Find all available toll free numbers
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function findAvailableTollFree(string $pbx)
    {
        return $this->send("pbx/{$pbx}/numbers/tf")->numbers;
    }

    /**
     * Find all available vfax numbers by stae
     * @param string $pbx
     * @param string $state
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function findAvailableVFax(string $pbx, string $state)
    {
        return $this->send("pbx/{$pbx}/numbers/vfax", 'POST', [
            'state' => $state
        ]);
    }

    /**
     * Purchase a number found from the available list.
     * @param string $pbx
     * @param string $numberKey This is a key returned from available lists. (ex. lc_1_4044001766)
     * @return mixed - Returns an object with the UUID
     * @throws \EvolveAPI\EVException
     */
    public function purchaseNumber(string $pbx, string $numberKey)
    {
        return $this->send("pbx/{$pbx}/numbers/purchase", 'POST', [
            'number' => $numberKey
        ])->number;
    }


}