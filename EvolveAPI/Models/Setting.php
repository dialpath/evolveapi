<?php
namespace EvolveAPI\Models;
use EvolveAPI\EVCore;

/**
 * Class Setting
 * @package EvolveAPI\Models
 */
class Setting extends EVCore
{
    /**
     * Settings Constructor
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of Settings for the PBX
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/settings")->settings;
    }


    /**
     * Get a Setting
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/settings/{$uuid}")->setting;
    }

    /**
     * Change Setting(s)
     * @param string $pbx
     * @param array $settings
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, array $settings)
    {
        return $this->send("pbx/{$pbx}/settings", 'POST', $settings);
    }


}