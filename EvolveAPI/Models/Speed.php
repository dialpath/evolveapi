<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

class Speed extends EVCore
{

    /**
     * Speed Dial Constructor
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of Speed Dials
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/speeds")->speeds;
    }


    /**
     * Get a speed dial
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/speeds/{$uuid}")->speed;
    }

    /**
     * Create a new Speed Dial
     * @param string $pbx UUID of the PBX
     *
     * @param string $name
     * @param string $source
     * @param string $destination
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, string $name, string $source, string $destination)
    {
        return $this->send("pbx/{$pbx}/speeds", 'POST', [
            'name'        => $name,
            'source'      => $source,
            'destination' => $destination
        ]);
    }

    /**
     * Update a Speed Dial
     * @param string $pbx
     * @param string $uuid
     * @param string $name
     * @param string $source
     * @param string $destination
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, string $name, string $source, string $destination)
    {
        return $this->send("pbx/{$pbx}/speeds/{$uuid}", 'PUT', [
            'name'        => $name,
            'source'      => $source,
            'destination' => $destination
        ]);
    }

    /**
     * Remove a Speed Dial
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/speeds/{$uuid}", 'DELETE');
    }
}