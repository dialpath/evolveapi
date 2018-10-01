<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class Attendant
 * @package EvolveAPI\Models
 */
class Attendant extends EVCore
{

    /**
     * Attendant constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of auto attendants currently in the PBX.
     * @param string $pbx
     * @return Conditions
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/attendants")->attendants;
    }

    /**
     * Get a single condition
     * @param string $pbx
     * @param string $uuid
     * @return Condition
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/attendants/{$uuid}")->attendant;
    }

    /**
     * Create a new auto attendant and return the UUID
     * @param string $pbx
     * @param array $params
     *   name : string : The name of the auto attendant
     *   welcome : string : The UUID of the sound file to play when the attendant starts
     *   att_timeout : int : The number of seconds after the sound file plays to wait for a response
     *   digit_timeout : int : The number of seconds to allow between digits. (default 2)
     *   loop_timeout : bool : If someone exceeds the time limit, start over? false = hangup.
     *   loop_wrongkey : bool : If someone presses an invalid entry, let them start over? false = hangup
     *   disa : bool : Enable Direct dialing of extensions or internal codes?
     *   features : bool : Enable the ability to use feature codes from the IVR menu?
     *   timeout : array of dial paths for when the IVR times out.
     *   optional features
     *      path_0 - Array of dial paths for when 0 is pressed.
     *      path_1 - Array of dial paths for when 1 is pressed.
     *      path_2 - Array of dial paths for when 2 is pressed.
     *      path_3 - Array of dial paths for when 3 is pressed.
     *      path_4 - Array of dial paths for when 4 is pressed.
     *      path_5 - Array of dial paths for when 5 is pressed.
     *      path_6 - Array of dial paths for when 6 is pressed.
     *      path_7 - Array of dial paths for when 7 is pressed.
     *      path_8 - Array of dial paths for when 8 is pressed.
     *      path_9 - Array of dial paths for when 9 is pressed.
     *      path_s - Array of dial paths for when * is pressed.
     *      path_h - Array of dial paths for when # is pressed.
     *
     * @return string
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, array $params): string
    {
        return $this->send("pbx/{$pbx}/attendants", 'POST', $params)->uuid;
    }

    /**
     * Update an auto attendant using the same parameters as above.
     * @param string $pbx
     * @param $uuid
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, array $params)
    {
        return $this->send("pbx/{$pbx}/attendants/{$uuid}", 'PUT', $params);
    }

    /**
     * Remove an auto attendant, and all its configurations
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/attendants/{$uuid}", 'DELETE');
    }

    /**
     * gets the logs for this attendant (IVR)
     * @param string $pbx
     * @param string $uuid
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function logs(string $pbx, string $uuid, $params = [])
    {
        return $this->send("pbx/{$pbx}/attendants/{$uuid}/logs", 'GET', $params)->logs;
    }
}