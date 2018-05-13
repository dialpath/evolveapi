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
     * @param string $name - The name of the mailbox (i.e. General Sales)
     * @param int $mailbox - The mailbox number/extension for this mailbox
     * @param int $passcode - The 4 digit passcode for the mailbox
     * @param string $email (optional) - The voicemail to email address to use
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, string $name, int $mailbox, int $passcode, string $email)
    {
        return $this->send("pbx/{$pbx}/voicemails", 'POST', [
            'name'     => $name,
            'mailbox'  => $mailbox,
            'passcode' => $passcode,
            'email'    => $email
        ]);
    }

    /**
     * Update a Voicemail
     * @param string $pbx
     * @param string $uuid
     * @param string $name
     * @param int $mailbox
     * @param int $passcode
     * @param string $email
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, string $name, int $mailbox, int $passcode, string $email)
    {
        return $this->send("pbx/{$pbx}/voicemails/{$uuid}", 'PUT', [
            'name'     => $name,
            'mailbox'  => $mailbox,
            'passcode' => $passcode,
            'email'    => $email
        ]);
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