<?php
/**
 * Created by PhpStorm.
 * User: cdc
 * Date: 01-Aug-18
 * Time: 7:23 PM
 */

namespace EvolveAPI\Models;


use EvolveAPI\EVCore;

class Blacklist extends EVCore
{
    /**
     * Action Constructor
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of PBX Blacklist Entries
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/blacklist")->entries;
    }

    /**
     * Get a Blacklist Entry
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/actions/{$uuid}")->entry;
    }

    /**
     * Creates a Blacklist entry
     *
     * @param string $pbx
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, array $params)
    {
        return $this->send("pbx/{$pbx}/blacklist", 'POST', $params);
    }

    /**
     * Update a Blacklist entry
     *
     * @param string $pbx
     * @param string $uuid
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, array $params)
    {
        return $this->send("pbx/{$pbx}/blacklist/{$uuid}", 'PUT', $params);
    }

    /**
     * Remove a Blacklist Entry
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/blacklist/{$uuid}", 'DELETE');
    }
}