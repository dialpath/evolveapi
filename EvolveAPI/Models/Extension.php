<?php
namespace EvolveAPI\Models;
use EvolveAPI\EVCore;

/**
 * Class Extension
 *
 * The Extension class handles all extension updates, name changes, dial paths for when
 * an extension is offline, busy, or forced to re-route somewhere else.
 *
 * @package EvolveAPI\Models
 */
class Extension extends EVCore
{
    /**
     * Extension constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get all extensions for a PBX.
     * @param string $pbx
     * @return arrays
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/extensions")->extensions;
    }

    /**
     * Create a new Extension
     * @param string $pbx
     * @param array $params
     *  name : string : The name of the extension (20 char max)
     *  extension : int : The 3-4 digit extension
     *  caller_id : bigInt : the 10 digit Caller ID (must exist on your account)
     *  emergency_id : bigInt : the 10 digit E911 Caller ID (must exist on your account)
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, array $params)
    {
        return $this->send("pbx/{$pbx}/extensions", 'POST', $params);
    }

    /**
     * @param string $pbx
     * @param array $params
     * start_extension : integer : extension number to start from
     * end_extension : integer : The 3-4 digit extension to end at
     * caller_id : bigInt : the 10 digit Caller ID (must exist on your account)
     * emergency_id : bigInt : the 10 digit E911 Caller ID (must exist on your account)
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function createBulk(string $pbx, array $params)
    {
        return $this->send("pbx/{$pbx}/extensions/bulk", 'POST', $params)->extensions;
    }

    /**
     * Update an Extension
     * @param string $pbx
     * @param $uuid
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, $uuid, array $params)
    {
        return $this->send("pbx/{$pbx}/extensions/{$uuid}", "PUT", $params);
    }

    /**
     * Get a single Extension and its login information
     * @param string $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, $uuid)
    {
        return $this->send("pbx/{$pbx}/extensions/{$uuid}")->extension;
    }

    /**
     * Remove an Extension, its Voicemail and all associated paths.
     * @param string $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, $uuid)
    {
        return $this->send("pbx/{$pbx}/extensions/{$uuid}", 'DELETE');
    }

    /**
     * Enable Voicemail for an Extension
     * @param string $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function enableVoicemail(string $pbx, $uuid)
    {
        return $this->send("pbx/{$pbx}/extensions/{$uuid}/voicemail", 'POST');
    }

    /**
     * Update voicemail configuration
     * @param string $pbx
     * @param $uuid
     * @param array $params
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function updateVoicemail(string $pbx, $uuid, array $params)
    {
        return $this->send("pbx/{$pbx}/extensions/{$uuid}/voicemail", 'PUT', $params);
    }

    /**
     * Remove a voicemail box and its messages.
     * @param string $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function removeVoicemail(string $pbx, $uuid)
    {
        return $this->send("pbx/{$pbx}/extensions/{$uuid}/voicemail", 'DELETE');
    }


    /**
     * Enable Findme/Follow me for an extension.
     * @param string $pbx
     * @param $uuid
     * @param array $params -- Optional FMFM configuration. If not specified,
     * existing configuration will be applied.
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function setFollowMe(string $pbx, $uuid, array $params)
    {
        return $this->send("pbx/{$pbx}/extensions/{$uuid}/follow", 'POST', $params);
    }

    /**
     * Disable follow-me for an extension. This will not remove the configuration
     * it will just disable.
     * @param string $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function disableFollowMe(string $pbx, $uuid)
    {
        return $this->send("pbx/{$pbx}/extensions/{$uuid}/follow", 'DELETE');
    }

    /**
     * Change/Reset Password for an Extension
     * @param string $pbx
     * @param $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function reset(string $pbx, $uuid)
    {
        return $this->send("pbx/{$pbx}/extensions/{$uuid}/reset", 'POST')->secret;
    }

    /**
     * Assign an extension to a phone
     * @param string $pbx
     * @param string $uuid
     * @param string $phone_uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function assignPhone(string $pbx, string $uuid, string $phone_uuid)
    {
        return $this->send("pbx/{$pbx}/extensions/{$uuid}/phone", 'POST', [
            'phone' => $phone_uuid
        ]);
    }

    /**
     * Unassign a phone from an extension and make it available
     * @param string $pbx
     * @param string $uuid
     * @param string $phone_uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function unassignPhone(string $pbx, string $uuid, string $phone_uuid)
    {
        return $this->send("pbx/{$pbx}/extensions/{$uuid}/phone/$phone_uuid", 'DELETE');
    }

    /**
     * Enabled/Disables the unconditional forwarding
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function toggleUnconditionalForwarding(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/extensions/{$uuid}/unconditional_toggle", 'POST');
    }

}