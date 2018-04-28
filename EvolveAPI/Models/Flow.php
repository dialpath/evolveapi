<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

class Flow extends EVCore
{

    /**
     * Call Flow
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of Call Flows
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/flows")->flows;
    }


    /**
     * Get a Call Flow
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/flows/{$uuid}")->flow;
    }

    /**
     * Create a new Call Flow
     * @param string $pbx UUID of the PBX
     * @param array $settings
     *  name : string : The name of the Call Flow
     *  extension : int : The extension number to activate the flow.
     *  description : string : Additional description of what this flow does
     *  paths : array : A list of dial paths to use for this flow.
     *
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, array $settings)
    {
        return $this->send("pbx/{$pbx}/flows", 'POST', $settings);
    }

    /**
     * Update a Flow - Same parameters as create
     * @param string $pbx
     * @param string $uuid
     * @param array $settings
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, array $settings)
    {
        return $this->send("pbx/{$pbx}/flows/{$uuid}", 'PUT', $settings);
    }

    /**
     * Remove a Call Flow
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/flows/{$uuid}", 'DELETE');
    }
}