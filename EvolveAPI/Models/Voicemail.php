<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

class Voicemail extends EVCore
{
    /**
     * Voicemail Constructor
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     *
     * Get a list of Voicemails
     * @param string $pbx
     * @param bool $includeExtensions - Include personal voicemails? Or just Generic Voicemail boxes
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx, $includeExtensions = false)
    {
        $withExtensions = $includeExtensions ? ['withExtensions' => true] : [];
        return $this->send("pbx/{$pbx}/voicemails", 'GET', $withExtensions)->voicemails;
    }


    /**
     * Get a Voicemail
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/voicemails/{$uuid}")->voicemail;
    }

    /**
     * Create a new Generic Voicemail box
     * NOTE: This should not be used to create extension voicemails. If you attempt to create
     * a mailbox attached to an extension this will fail, use the Extension model method enableVoicemail
     * @param string $pbx UUID of the PBX
     *
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, array $params)
    {
        return $this->send("pbx/{$pbx}/voicemails", 'POST', $params);
    }

    /**
     * Update a Voicemail
     * @param string $pbx
     * @param string $uuid
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, $params = [])
    {
        return $this->send("pbx/{$pbx}/voicemails/{$uuid}", 'PUT', $params);
    }

    /**
     * Remove a Generic Voicemail box
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/voicemails/{$uuid}", 'DELETE');
    }

    /**
     * Get a Voicemail Message
     * @param string $pbx
     * @param string $voicemail
     * @param string $message
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function getMessage(string $pbx, string $voicemail, string $message)
    {
        return $this->send("pbx/{$pbx}/voicemails/$voicemail/messages/$message")->message;
    }

    /**
     * Upload a base64 encoded WAV or MP3 file to set as the greeting for a voicemail.
     * @param string $pbx
     * @param string $voicemail
     * @param string $greeting
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function uploadGreeting(string $pbx, string $voicemail, string $greeting)
    {
        return $this->send("pbx/{$pbx}/voicemails/$voicemail/greeting", 'POST', [
            'greeting' => $greeting
        ]);
    }
}