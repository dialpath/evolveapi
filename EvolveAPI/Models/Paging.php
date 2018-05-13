<?php

namespace EvolveAPI\Models;
use EvolveAPI\EVCore;

/**
 * Class Paging
 * @package EvolveAPI\Models
 */
class Paging extends EVCore
{

    /**
     * Paging/Intercom constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of Paging/Intercom Groups.
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/paging")->paging;
    }


    /**
     * Get a Paging/Intercom Group
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/paging/{$uuid}")->page;
    }

    /**
     * Create a new Paging/Intercom Group
     * @param string $pbx UUID of the PBX
     * @param array $settings
     *  name : string : The name of the Paging/Intercom Group
     *  extension : int : The extension number to dial this group directly
     *  intercom : bool : If true, two-way communication will be created.
     *  skipbusy : bool : If true, extensions in use will not be called.
     *  pin : int : PIN code to access this paging group
     *
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, array $settings)
    {
        return $this->send("pbx/{$pbx}/paging", 'POST', $settings);
    }

    /**
     * Update a Paging group - Same parameters as create
     * @param string $pbx
     * @param string $uuid
     * @param array $settings
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, array $settings)
    {
        return $this->send("pbx/{$pbx}/paging/{$uuid}", 'PUT', $settings);
    }

    /**
     * Remove a Paging/Intercom Group
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/paging/{$uuid}", 'DELETE');
    }
}