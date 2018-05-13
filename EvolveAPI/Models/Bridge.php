<?php
namespace EvolveAPI\Models;
use EvolveAPI\EVCore;

/**
 * Class Bridge
 * @package EvolveAPI\Models
 */
class Bridge extends EVCore
{
    /**
     * Conference Bridge constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of Conference Bridges.
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/bridges")->bridges;
    }

    /**
     * Get a Bridge
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/bridges/{$uuid}")->bridge;
    }

    /**
     * Create a new Conference Bridge
     * @param string $pbx UUID of the PBX
     * @param array $settings
     *  name : string : The name of the Conference
     *  extension : int : The extension number to dial this bridge directly
     *  available : start datetime, end datetime : If you wish to only have this conference available during a specific time.
     *  pin : int : PIN code to access this conference
     *
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, array $settings)
    {
        return $this->send("pbx/{$pbx}/bridges", 'POST', $settings);
    }

    /**
     * Update a Bridge - Same parameters as create
     * @param string $pbx
     * @param string $uuid
     * @param array $settings
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, array $settings)
    {
        return $this->send("pbx/{$pbx}/bridges/{$uuid}", 'PUT', $settings);
    }

    /**
     * Remove a Conference Bridge.
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/bridges/{$uuid}", 'DELETE');
    }
}