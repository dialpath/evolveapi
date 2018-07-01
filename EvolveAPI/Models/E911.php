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
     * Get a list of all E911 locations currently stored in DialPath
     */
    public function all()
    {
        return $this->send("e911")->locations;
    }

    /**
     * Get a single E911 Location
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $uuid)
    {
        return $this->send("e911/{$uuid}")->location;
    }

    /**
     * Add an E911 Location. Once a location has been added and validated,
     * you can assign telephone numbers on your account to those locations.
     * You can lookup valid E911 addresses using the USPS lookup tool.
     * @reference https://tools.usps.com/zip-code-lookup.htm?byaddress
     * @param array $locationData
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(array $locationData)
    {
        return $this->send("e911", 'post', ['location' => $locationData]);
    }

    /**
     * Update an existing location.
     * NOTE: This will change the e911 Location information for all numbers currently assigned
     * to this location.
     * @param $uuid
     * @param array $locationData
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update($uuid, array $locationData)
    {
        return $this->send("e911/{$uuid}", 'post', ['location' => $locationData]);
    }

    /**
     * Remove an E911 location. This will remove any telephone number associations
     * to this address. Make sure you update your numbers accordingly.
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $uuid)
    {
        return $this->send("e911/{$uuid}", 'DELETE');
    }

}