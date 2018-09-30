<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class CallRecording
 * This class provides access to all call recordings on numbers and extensions.
 * @package EvolveAPI\Models
 */
class CallRecording extends EVCore
{
    /**
     * CallRecording constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get all recordings for a PBX
     * @param string $pbx
     * @param string $start
     * @param string $end
     * @return array
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx, string $start, string $end)
    {
        return $this->send("pbx/{$pbx}/recordings", [
            'start' => $start,
            'end'   => $end
        ])->recordings;
    }

    /**
     * Get a recording by UUID
     * Returns data (base64 encoded) and format (format the file was stored in)
     * and size (the size of the file)
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/recordings/$uuid");
    }

    /**
     * Purge a call recording from the server. This will not remove
     * your local copy if using a polling service.
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function purge(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/recordings/$uuid", 'DELETE');
    }
}