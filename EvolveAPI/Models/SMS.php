<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class SMS
 * @package EvolveAPI\Models
 */
class SMS extends EVCore
{
    /**
     * SMS constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get all SMS enabled numbers for a PBX
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/sms")->numbers;
    }

    /**
     * List all SMS messages for a Number
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/sms/{$uuid}")->messages;
    }

    /**
     * Deletes a sms given it's uuid
     *
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/sms/{$uuid}", 'DELETE');
    }

    /**
     * Gets all the sms numbers with the messages
     *
     * @param $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function getSMSMessages($pbx)
    {
        return $this->send("pbx/{$pbx}/sms_messages")->numbers;
    }

    /**
     * Send a SMS.
     * @param string $pbx
     * @param string $number The source UUID
     * @param array $sms
     *  'destination' => 10 digit number of the recipient.
     *  'message' => The message to send
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function sendSMS(string $pbx, string $number, array $sms)
    {
        return $this->send("pbx/{$pbx}/vfaxes/{$number}/sms/{$number}", 'POST', $sms);
    }


}