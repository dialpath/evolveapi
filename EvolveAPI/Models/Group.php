<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class Group
 * @package EvolveAPI\Models
 */
class Group extends EVCore
{
    /**
     * Ring Group constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of Ring Groups.
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/groups")->groups;
    }

    /**
     * Get a Ring Group
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/groups/{$uuid}")->group;
    }

    /**
     * Create a new Ring Group
     * @param string $pbx UUID of the PBX
     * @param array $settings
     *  name : string : The name of the ring group
     *  extension : int : The extension number to dial this group directly
     *  paths : array : A list of extension UUIDs to include in this group.
     *  type : string : RINGALL, CYCLE, SEQUENCE (default RINGALL)
     *  rg_timeout : int : Time before timeout (default 25 seconds/5 rings)
     *  skip_busy : bool : Skip extensions if they are in use (default true)
     *  moh : bool : Play music on hold instead of ringing? (default false)
     *  fmfm : bool : Allow Follow me to be executed when an extension has this enabled in the group (default false)
     *  timeout : array : A list of paths to use in the event this ring group times out
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, array $settings)
    {
        return $this->send("pbx/{$pbx}/groups", 'POST', $settings);
    }

    /**
     * Update a Ring Group - Same parameters as create
     * @param string $pbx
     * @param string $uuid
     * @param array $settings
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, array $settings)
    {
        return $this->send("pbx/{$pbx}/groups/{$uuid}", 'PUT', $settings);
    }

    /**
     * Remove a ring group its dial paths.
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/groups/{$uuid}", 'DELETE');
    }
}