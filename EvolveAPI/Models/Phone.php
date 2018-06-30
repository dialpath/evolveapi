<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class Phone
 * @package EvolveAPI\Models
 */
class Phone extends EVCore
{
    /**
     * Get all phones on a customer's account. If a PBX is specified
     * then this function will only return the phones on that specific PBX
     * and their corresponding extension
     * @param null $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all($pbx = null)
    {
        return $this->send("phones", 'GET', ['pbx' => $pbx])->phones;
    }

    /**
     * Get a phone's configuration from its UUID
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find($uuid)
    {
        return $this->send("phones/{$uuid}")->phone;
    }

    /**
     * Get a list of supported brands/models
     */
    public function getSupportedPhones()
    {
        return $this->send("phones/brands")->brands;
    }

    /**
     * Configure a phone in the DialPath provisioning server.
     * @param $uuid
     * @param array $settings
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function updatePhoneSettings($uuid, array $settings)
    {
        return $this->send("phones/{$uuid}/settings", 'POST', $settings);
    }

    /**
     * Update Line Key associations for a phone
     * @param $uuid
     * @param array $lines
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function updateLineKeys($uuid, array $lines)
    {
        return $this->send("phones/{$uuid}/lines", 'POST', $lines);
    }

    /**
     * Update Extension/Account settings for a phone.
     * @param $uuid
     * @param array $accounts
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function updateAccounts($uuid, array $accounts)
    {
        return $this->send("phones/{$uuid}/accounts", 'POST', $accounts);
    }

    /**
     * Add a new phone to the DialPath provisioning server. This is automatically done
     * for customers purchasing devices through DialPath directly.
     * @param string $mac
     * @param string $description
     * @param int $model
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function addPhone(string $mac, string $description, int $model)
    {
        return $this->send("phones", 'POST', [
            'mac'         => $mac,
            'description' => $description,
            'model_id'    => $model
        ]);
    }

    /**
     * Remove a phone from the DialPath Provisioning server
     * @param $mac
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function removePhone($mac)
    {
        return $this->send("phones/{$mac}", 'DELETE');
    }

}