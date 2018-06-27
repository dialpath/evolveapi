<?php
/**
 * Created by PhpStorm.
 * User: cdc
 * Date: 27-Jun-18
 * Time: 5:46 PM
 */

namespace EvolveAPI\Models;


use EvolveAPI\EVCore;

class VoiceMailMessage extends EVCore
{
    /**
     * VoiceMailMessage constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * @param string $pbx
     * @param string $vm
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx, string $vm)
    {
        return $this->send("pbx/{$pbx}/voicemails/{$vm}/messages", 'GET')->messages;
    }
}