<?php
/**
 * Class Server
 *
 * This class contains all servers associated to an enviornment and their roles.
 * This is used for customers who have their own custom environments.
 *
 * There are no create/update/delete methods on this, as servers
 * are managed by DialPath Support.
 *
 * @author Chris Horne <chris@dialpath.com>
 * @package EvolveAPI\Models
 */

namespace EvolveAPI\Models;


use EvolveAPI\EVCore;

class Server extends EVCore
{

    /**
     * Get a list of all servers for an environment.
     * Note: Limited availability of env and server calls for
     * DialPath owned enviornments.
     *
     * @param string $environment
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $environment)
    {
        return $this->send("environments/$environment/servers");
    }

    /**
     * Get a server by its UUID
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $uuid)
    {
        return $this->send("server/$uuid");
    }

    


}