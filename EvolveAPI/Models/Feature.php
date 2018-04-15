<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 4/15/18
 * Time: 3:47 PM
 */

namespace EvolveAPI\Models;


use EvolveAPI\EVCore;

class Feature extends EVCore
{

    /**
     * Feature Code constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of feature codes.
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/codes")->codes;
    }


    /**
     * Get a Feature Code
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/codes/{$uuid}")->code;
    }

    /**
     * Create a new Feature Code
     * @param string $pbx UUID of the PBX
     * @param string $code Feature code including * key. (ie *97)
     * @param string $description Description of what this code does.
     * @param array $paths
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, string $code, string $description, $paths = [])
    {
        return $this->send("pbx/{$pbx}/codes", 'POST', [
            'code'        => $code,
            'description' => $description,
            'paths'       => $paths
        ]);

    }

    /**
     * Update a code
     * @param string $pbx
     * @param string $uuid
     * @param string $code
     * @param string $description
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, string $code, string $description, $paths = [])
    {
        return $this->send("pbx/{$pbx}/codes/{$uuid}", 'PUT', [
            'code'        => $code,
            'description' => $description,
            'paths'       => $paths
        ]);
    }

    /**
     * Remove a feature code and its dial paths.
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/codes/{$uuid}", 'DELETE');
    }
}