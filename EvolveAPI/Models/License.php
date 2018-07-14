<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 7/8/18
 * Time: 8:44 AM
 */

namespace EvolveAPI\Models;


use EvolveAPI\EVCore;

/**
 * Class License
 * Manage your active licenses for carrier lines of service, queues, and conference bridges
 * @package EvolveAPI\Models
 */
class License extends EVCore
{
    /**
     * License constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get the current licenses for the PBX
     * @param string $pbx
     * @return object
     * @throws \EvolveAPI\EVException
     */
    public function getLicenses(string $pbx)
    {
        return $this->send("pbx/{$pbx}/licenses")->licenses;
    }

    /**
     * Set the licenses for a PBX. This will directly affect billing
     * of your PBX. If you remove licenses your recurring\ invoice will
     * go down. If you add, you will be charged applicable provisioning fees
     * as well as your recurring invoice updated to reflect the changes.
     * @param string $pbx
     * @param array $licenses
     * @return object
     * @throws \EvolveAPI\EVException
     */
    public function setLicenses(string $pbx, array $licenses = [])
    {
        return $this->send("pbx/{$pbx}/licenses", 'POST', ['licenses' => $licenses])->licenses;
    }

}