<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class Network
 * @package EvolveAPI\Models
 */
class Network extends EVCore
{
    /**
     * Network constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }


    /**
     * Get a list of monitored networks for a PBX
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/networks")->networks;
    }

    /**
     * Add a network to be monitored.
     * NOTE: Must be ICMP accessible from 198.8.85.0/24 and 192.252.211.192/26
     * @param string $pbx
     * @param string $ip
     * @param string $description
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, string $ip, string $description)
    {
        return $this->send("pbx/{$pbx}/networks", 'POST', [
            'ip'          => $ip,
            'description' => $description
        ])->network;
    }

    /**
     * Find a network, and get latest graph
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/networks/{$uuid}")->network;
    }

    /**
     * Get a list of events for a network
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function events(string $pbx, string $uuid, $start = null, $end = null)
    {
        return $this->send("pbx/{$pbx}/networks/{$uuid}/events?start=$start&end=$end")->events;
    }

    /**
     * Get an Event and graphs associated to the event.
     * @param string $pbx
     * @param string $network
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function showEvent(string $pbx, string $network, string $uuid)
    {
        return $this->send("pbx/{$pbx}/networks/{$network}/events/{$uuid}")->event;
    }

    /**
     * Update an existing monitored network.
     * @param string $pbx
     * @param string $uuid
     * @param string $ip
     * @param string $description
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, string $ip, string $description)
    {
        return $this->send("pbx/{$pbx}/networks/{$uuid}", 'PUT', [
            'ip'          => $ip,
            'description' => $description
        ])->network;
    }

    /**
     * Remove a network from monitoring.
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function destroy(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/networks/{$uuid}", 'DELETE');
    }

}