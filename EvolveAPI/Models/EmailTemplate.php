<?php
/**
 * Created by PhpStorm.
 * User: cdc
 * Date: 26-Jul-18
 * Time: 1:57 PM
 */

namespace EvolveAPI\Models;


use EvolveAPI\EVCore;

class EmailTemplate extends EVCore
{
    /**
     * Email Template constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * @param string $pbx
     * @param string $type
     * @return EmailTemplate
     * @throws \EvolveAPI\EVException
     */
    public function showTemplate(string $pbx, string $type)
    {
        return $this->send("pbx/{$pbx}/templates/{$type}")->template;
    }

    /**
     * @param string $pbx
     * @param string $type
     * @param array $params
     * @return string
     * @throws \EvolveAPI\EVException
     */
    public function updateTemplate(string $pbx, string $type, array $params = [])
    {
        return $this->send("pbx/{$pbx}/templates/{$type}", 'PUT', $params)->template;
    }
}