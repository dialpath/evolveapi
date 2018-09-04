<?php
/**
 * Created by PhpStorm.
 * User: cdc
 * Date: 04-Sep-18
 * Time: 1:21 PM
 */

namespace EvolveAPI\Models;


use EvolveAPI\EVCore;

class DirectoryEntry extends EVCore
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
     * Get a list of  Directory Entries
     * @param string $pbx
     * @param string $directory
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx, string $directory)
    {
        return $this->send("pbx/{$pbx}/directories/{$directory}/entries")->entries;
    }

    /**
     * Get a  Directory Entry
     * @param string $pbx
     * @param string $directory
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $directory, string $uuid)
    {
        return $this->send("pbx/{$pbx}/directories/{$directory}/entries/{$uuid}")->directory;
    }

    /**
     * Create a new  Directory Entry
     * @param string $pbx
     * @param string $directory
     * @param array $settings
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, string $directory, array $settings)
    {
        return $this->send("pbx/{$pbx}/directories/{$directory}/entries", 'POST', $settings);
    }

    /**
     * Update a Directory  Entry - Same parameters as create
     * @param string $pbx
     * @param string $directory
     * @param string $uuid
     * @param array $settings
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $directory, string $uuid, array $settings)
    {
        return $this->send("pbx/{$pbx}/directories/{$directory}/entries/{$uuid}", 'PUT', $settings);
    }

    /**
     * Remove a  Directory Entry
     * @param string $pbx
     * @param string $directory
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $directory, string $uuid)
    {
        return $this->send("pbx/{$pbx}/directories/{$directory}/entries/{$uuid}", 'DELETE');
    }
}