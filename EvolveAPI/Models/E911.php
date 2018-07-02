<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 7/1/18
 * Time: 7:43 PM
 */

namespace EvolveAPI\Models;


use EvolveAPI\EVCore;

class E911 extends EVCore
{
    /**
     * Extension constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of all E911 locations currently stored in DialPath
     * @param string $pbx Specify a UUID of a PBX or use 'all' to get all
     * locations on the account.
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx = 'all')
    {
        return $this->send("pbx/{$pbx}/e911")->locations;
    }

    /**
     * Get a single E911 Location
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/e911/{$uuid}")->location;
    }

    /**
     * Add an E911 Location. Once a location has been added and validated,
     * you can assign telephone numbers on your account to those locations.
     * You can lookup valid E911 addresses using the USPS lookup tool.
     * @reference https://tools.usps.com/zip-code-lookup.htm?byaddress
     * @param string $pbx
     * @param array $locationData
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, array $locationData)
    {
        return $this->send("pbx/{$pbx}/e911", 'post', ['location' => $locationData]);
    }

    /**
     * Update an existing location.
     * NOTE: This will change the e911 Location information for all numbers currently assigned
     * to this location.
     * @param string $pbx
     * @param string $uuid
     * @param array $locationData
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, array $locationData)
    {
        return $this->send("pbx/{$pbx}/e911/{$uuid}", 'post', ['location' => $locationData]);
    }

    /**
     * Remove an E911 location. This will remove any telephone number associations
     * to this address. Make sure you update your numbers accordingly.
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/e911/{$uuid}", 'DELETE');
    }

}