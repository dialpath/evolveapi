<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class VoiceMailMessage
 * @package EvolveAPI\Models
 */
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
     * Get a list of all voicemail messages in a mailbox
     * @param string $pbx
     * @param string $vm
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx, string $vm)
    {
        return $this->send("pbx/{$pbx}/voicemails/{$vm}/messages", 'GET')->messages;
    }

    /**
     * @param string $pbx
     * @param string $vm
     * @param string $messageNumber
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $vm, string $messageNumber)
    {
        return $this->send("pbx/{$pbx}/voicemails/{$vm}/messages/{$messageNumber}")->recording;
    }

    /**
     * @param string $pbx
     * @param string $vm
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function addMessage(string $pbx, string $vm, array $params)
    {
        return $this->send("pbx/{$pbx}/voicemails/{$vm}/messages", 'POST', $params);
    }

    /**
     * Remove a message from a mailbox.
     * @param string $pbx
     * @param string $vm
     * @param string $id
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $vm, string $id)
    {
        return $this->send("pbx/{$pbx}/voicemails/{$vm}/messages/{$id}", 'DELETE');
    }
}