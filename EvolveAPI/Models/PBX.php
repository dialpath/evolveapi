<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 4/10/18
 * Time: 4:11 PM
 */

namespace EvolveAPI\Models;


use EvolveAPI\EVCore;

/**
 * Class PBX
 *
 * The PBX model will give you information on all the different PBXes you have
 * provisioned based on the environment specified. This will also allow you to
 * instantly provision new PBXes and update the base information and settings
 * for a given PBX.
 *
 * @author Chris Horne <chris@dialpath.com>
 * @package EvolveAPI\Models
 */
class PBX extends EVCore
{
    /**
     * PBX constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get all PBXes for an environment
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all()
    {
        return $this->send("pbx")->pbxes;
    }

    /**
     * Build a new PBX
     * @param $name - The name of the company (i.e. ACME Business)
     * @param null $timezone - Timezone (GMT (-1 to +14)) or leave blank for Eastern (-5)
     * @param null $route
     * @return object New PBX Object
     * @throws \EvolveAPI\EVException
     */
    public function create($name, $timezone = null, $route = null)
    {
        return $this->send("pbx", 'POST', [
            'name'     => $name,
            'timezone' => $timezone,
            'route'    => $route,
        ])->pbx;
    }

    /**
     * Update a PBX
     * @param $uuid
     * @param null $name
     * @param null $timezone
     * @param null $route
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update($uuid, $name = null, $timezone = null, $route = null)
    {
        $fields = [];
        if ($name) $fields['name'] = $name;
        if ($timezone) $fields['timezone'] = $timezone;
        if ($route) $fields['route'] = $route;
        return $this->send("pbx/{$uuid}", 'PUT', $fields)->pbx;
    }



}