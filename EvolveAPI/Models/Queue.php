<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class Queue
 * @package EvolveAPI\Models
 */
class Queue extends EVCore
{
    /**
     * Queue Constructor
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     *
     * Get a list of Queues
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/queues", 'GET')->queues;
    }


    /**
     * Get a Queue
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/queues/{$uuid}")->queue;
    }

    /**
     * Create a new Queue
     * @param string $pbx UUID of the PBX
     *
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, array $params)
    {
        return $this->send("pbx/{$pbx}/queues", 'POST', $params);
    }

    /**
     * Update a Queue's settings
     * @param string $pbx
     * @param string $uuid
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, $params = [])
    {
        return $this->send("pbx/{$pbx}/queues/{$uuid}", 'PUT', $params);
    }

    /**
     * Remove a Queue
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/queues/{$uuid}", 'DELETE');
    }

    /**
     * @param string $pbx
     * @param string $queue
     * @param array $params
     * @return mixedr
     * @throws \EvolveAPI\EVException
     */
    public function updateAgents(string $pbx, string $queue, $params = [])
    {
        return $this->send("pbx/{$pbx}/queues/{$queue}/agents", 'POST', $params);
    }

    /**
     * @param string $pbx
     * @param string $queue
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function getAgents(string $pbx, string $queue)
    {
        return $this->send("pbx/{$pbx}/queues/{$queue}/agents")->agents;
    }

    /**
     * gets the logs for this queue
     * @param string $pbx
     * @param string $uuid
     * @param array $params [start = null, end = null]
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function logs(string $pbx, string $uuid, array $params = [])
    {
        return $this->send("pbx/{$pbx}/queues/{$uuid}/logs", 'GET', $params);
    }

    /**
     * Generate a PDF report of call queue stats.
     * @param string $pbx
     * @param string $uuid
     * @param array $params [start = null, end = null, daily = bool]
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function generateReport(string $pbx, string $uuid, array $params = [])
    {
        return $this->send("pbx/{$pbx}/queues/{$uuid}/report", 'GET', $params)->report;
    }

}