<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class Environment
 *
 * Enviornments are clusters of PBX servers or single independent
 * servers that contain PBX data. Enviornments are either owned
 * individually by customers, or they are multi-tenant Dialpath owned
 * enviornments. Each PBX in an enviornment is completely segregated.
 *
 * @author Chris Horne <chris@dialpath.com>
 * @package EvolveAPI\Models
 */
class Environment extends EVCore
{
    /**
     * Get a list of available enviornments. If the 'private'
     * parameter is true, this denotes a custom enviornment.
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all()
    {
        return $this->send("enviornments");
    }

    /**
     * Get an enviornment details
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find($uuid)
    {
        return $this->send("enviornments/{$uuid}");
    }
}