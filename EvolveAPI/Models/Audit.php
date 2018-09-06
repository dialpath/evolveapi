<?php
namespace EvolveAPI\Models;
use EvolveAPI\EVCore;

/**
 * Class Audit
 * @package EvolveAPI\Models
 */
class Audit extends EVCore
{
    /**
     * Audit constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of all entries for this pbx
     * @param string $pbx
     * @return Conditions
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/audits")->entries;
    }

    /**
     * Get audit entries by subtype
     * @param string $pbx
     * @param string $subtype
     * @return array
     * @throws \EvolveAPI\EVException
     */
    public function bySubtype(string $pbx, string $subtype)
    {
        return $this->send("pbx/{$pbx}/audits/$subtype")->entries;

    }

    /**
     * Get audit entries by object
     * @param string $pbx
     * @param string $uuid
     * @return array
     * @throws \EvolveAPI\EVException
     */
    public function byObject(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/audits/$uuid")->entries;
    }


}