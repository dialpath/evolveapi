<?php
/**
 * Created by PhpStorm.
 * User: cdc
 * Date: 04-Sep-18
 * Time: 1:21 PM
 */

namespace EvolveAPI\Models;


use EvolveAPI\EVCore;

class Directory extends EVCore
{
    /**
     *  Directory
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of  Directories
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/directories")->directories;
    }

    /**
     * Get a  Directory
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/directories/{$uuid}")->directory;
    }

    /**
     * Create a new  Directory
     * @param string $pbx
     * @param array $settings
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, array $settings)
    {
        return $this->send("pbx/{$pbx}/directories", 'POST', $settings);
    }

    /**
     * Update a Directory - Same parameters as create
     * @param string $pbx
     * @param string $uuid
     * @param array $settings
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, array $settings)
    {
        return $this->send("pbx/{$pbx}/directories/{$uuid}", 'PUT', $settings);
    }

    /**
     * Remove a  Directory
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/directories/{$uuid}", 'DELETE');
    }
}