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
     * updates a phone's description
     * @param $uuid
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update($uuid, array $params)
    {
        return $this->send("phones/$uuid", 'PUT', $params)->uuid;
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
        return $this->send("phones/{$uuid}/settings", 'POST', ['settings' => $settings]);
    }

    /**
     * Assign a phone to a pbx.
     * WARNING: Changing this will remove any account/line/setting configurations.
     * @param $uuid
     * @param $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function assignToPBX($uuid, $pbx)
    {
        return $this->send("phones/{$uuid}/assign", 'POST', [
            'pbx' => $pbx
        ]);
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
        return $this->send("phones/{$uuid}/lines", 'POST', ['lines' => $lines]);
    }

    /**
     * Set Line keys for an expansion module (aka Sidecar)
     * @param $uuid
     * @param $index
     * @param array $lines
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function updateExpansionLineKeys($uuid, $index, array $lines)
    {
        return $this->send("phones/{$uuid}/expansions/{$index}/lines", 'POST', ['lines' => $lines]);
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
        return $this->send("phones/{$uuid}/accounts", 'POST', ['accounts' => $accounts]);
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

    /**
     * Get assignable line keys for this phone.
     * NOTE: Phone must be associated to a PBX before this call will return anything.
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function getAssignableLineKeys(string $uuid)
    {
        return $this->send("phones/{$uuid}/assignable/keys")->lines;
    }

    /**
     * Get assignable extensions/accounts for this phone.
     * NOTE: Phone must be associated to a PBX before this call will return anything.
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function getAssignableAccounts(string $uuid)
    {
        return $this->send("phones/{$uuid}/assignable/accounts")->accounts;
    }


}