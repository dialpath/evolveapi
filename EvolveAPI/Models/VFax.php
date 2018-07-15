<?php
namespace EvolveAPI\Models;
use EvolveAPI\EVCore;

/**
 * Class VFax
 * @package EvolveAPI\Models
 */
class VFax extends EVCore
{
    /**
     * Vfax constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get all vFax numbers for a PBX
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/vfaxes")->numbers;
    }

    /**
     * List all vFaxes for a Number
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/vfaxes/{$uuid}")->faxes;
    }

    /**
     * Retrieve a fax
     * @param string $pbx
     * @param string $number
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function getFax(string $pbx, string $number, string $uuid)
    {
        return $this->send("pbx/{$pbx}/vfaxes/{$number}/fax/{$uuid}")->fax;
    }

    /**
     * Send a fax.
     * @param string $pbx
     * @param string $number The source UUID
     * @param array $fax
     *  'destination' => 10 digit number of the recipient.
     *  'file' => base64 encoded PDF, DOC OR JPG
     *  'contact' => The contact name for the fax header
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function sendFax(string $pbx, string $number, array $fax)
    {
        return $this->send("pbx/{$pbx}/vfaxes/{$number}", 'POST', $fax);
    }


}