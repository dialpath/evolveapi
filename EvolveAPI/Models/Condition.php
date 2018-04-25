<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 4/20/18
 * Time: 2:47 PM
 */

namespace EvolveAPI\Models;


use EvolveAPI\EVCore;

class Condition extends EVCore
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
     * Get a list of Conditions currently in the PBX.
     * @param string $pbx
     * @return Conditions
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/conditions")->conditions;
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
        return $this->send("pbx/{$pbx}/conditions/{$uuid}")->condition;
    }

    /**
     * Create a new Condition and return a UUID
     * @param string $pbx
     * @param array $params
     * @return string
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, array $params = []): string
    {
        return $this->send("pbx/{$pbx}/conditions", 'POST', $params)->uuid;
    }

    /**
     * Update a condition
     * @param string $pbx
     * @param $uuid
     * @param array $params
     * @return string
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, $uuid, array $params = []): string
    {
        return $this->send("pbx/{$pbx}/conditions/{$uuid}", 'PUT', $params)->uuid;
    }

    /**
     * Delete a Condition
     * @param string $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, $uuid)
    {
        return $this->send("pbx/{$pbx}/conditions/{$uuid}", 'DELETE');
    }

    /**
     * Add or update a day to a condition. This can be used with WEEKTIME or CALENDAR only.
     * @param string $pbx
     * @param $uuid
     * @param string $day 0 (Sunday) - 6 (Saturday) or a date in YYYY/MM/DD format.
     * @param string $start 24 hour time to start condition
     * @param string $end 24 hour time to end condition
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function addDay(string $pbx, $uuid, $day = '0', $start = '00:00', $end = '23:59')
    {
        return $this->send("pbx/{$pbx}/conditions/$uuid/addDay", 'POST', [
            'day'   => $day,
            'start' => $start,
            'end'   => $end
        ]);
    }

    /**
     * Remove a day from a WEEKTIME or CALENDAR condition.
     * @param string $pbx
     * @param $uuid
     * @param string $day
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function removeDay(string $pbx, $uuid, $day = '0')
    {
        return $this->send("pbx/{$pbx}/conditions/$uuid/removeDay", 'DELETE', [
            'day' => $day
        ]);
    }
}