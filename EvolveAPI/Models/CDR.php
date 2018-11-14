<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class CDR
 * This class handles all call detail records for reporting and
 * individual calls.
 * @package EvolveAPI\Models
 */
class CDR extends EVCore
{
    /**
     * CDR constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get CDR information by PBX
     * @param string $pbx The PBX requested
     * @param string $start The start date/time
     * @param string $end The end date/time
     * @param bool $stats If true, an aggregated array will be returned. False will return a list of records
     * @param string $direction INBOUND, OUTBOUND, ALL
     * @param array $extensions if this parameter is inserted, cdrs will be filtered by the included extensions
     * leave null for all extensions
     * @param string $disposition
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(
        string $pbx,
        string $start,
        string $end,
        $stats = true,
        $direction = 'INBOUND',
        $extensions = [],
        $disposition = 'ANSWER'
    ) {
        return $this->send("pbx/{$pbx}/cdr", 'GET', [
            'start'       => $start,
            'end'         => $end,
            'direction'   => $direction,
            'stats'       => $stats,
            'extensions'  => $extensions,
            'disposition' => $disposition
        ])->cdrs;
    }

    /**
     * Get an individual call
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/cdr/{$uuid}")->cdr;
    }

    /**
     * get the events of the given cdr uuid
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function events(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/cdrs/{$uuid}/events")->events;
    }
}