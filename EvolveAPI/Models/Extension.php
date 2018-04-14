<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class Extension
 *
 * The Extension class handles all extension updates, name changes, dial paths for when
 * an extension is offline, busy, or forced to re-route somewhere else.
 *
 * @package EvolveAPI\Models
 */
class Extension extends EVCore
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
     * Get all extensions for a PBX.
     * @param string $pbx
     * @return arrays
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/extensions")->extensions;
    }

    /**
     * Create a new Extension
     * @param string $pbx
     * @param array $params
     *  name : string : The name of the extension (20 char max)
     *  extension : int : The 3-4 digit extension
     *  caller_id : bigInt : the 10 digit Caller ID (must exist on your account)
     *  emergency_id : bigInt : the 10 digit E911 Caller ID (must exist on your account)
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, array $params)
    {
        return $this->send("pbx/{$pbx}/extensions", 'POST', $params);
    }

    /**
     * Get a single Extension and its login information
     * @param string $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, $uuid)
    {
        return $this->send("pbx/{$pbx}/extensions/{$uuid}")->extension;
    }

    /**
     * Remove an Extension, its Voicemail and all associated paths.
     * @param string $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, $uuid)
    {
        return $this->send("pbx/{$pbx}/extensions/{$uuid}", 'DELETE');
    }
}