<?php

namespace EvolveAPI\Models;

use EvolveAPI\EVCore;

/**
 * Class Port
 * The port class handles all aspects of a port order within Dialpath.
 * How to Create a Port Order
 * 1. Create a new Port order using create(). Your numbers will be checked for portability automatically.
 * 2. If you do not opt to send the LOA automatically send the link found inside the port order (via show()).
 * 3. Have your end user sign the electronic LOA. Once signed, their IP address, name and signature will be recorded.
 *    NOTE: Your port will not be offically submitted until your customer signs the LOA.
 * 4. Upon signing your port orders will be submitted to the losing carrier for verification.
 * 5. You will receive status updates via a Dialpath support ticket as well as webhooks to your application to notify
 *    your end user.
 * 6. Should you receive a rejection, a member of our LNP staff will correspond with you through our normal support
 *    methods to correct mismatched data.
 * 7. Once a FOC (Firm Order of Commit) is received your numbers will be provisioned automatically to your PBX to
 *    prepare for final port.
 * @package EvolveAPI\Models
 */
class Port extends EVCore
{
    /**
     * Port constructor.
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of all orders
     * @param string $pbx Optionally set which PBX you are searching.
     * @param bool $completed Include Completed orders?
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx = null, $completed = false)
    {
        if ($pbx == null) $this->environment = null; // Ignore env. Get all.
        return $this->send($pbx ? "pbx/{$pbx}/port_orders" : "port_orders", 'get', [
            'completed' => $completed
        ]);
    }

    /**
     * Create a new Port Order
     * @param string $pbx The PBX/Customer this port order is for.
     * @param array $subscriberData The subscriber data listed below
     * @param array $numbers The array of numbers to port
     *
     * [subscriber_data]
     * losing_carrier - The name of the current carrier. (i.e. Windstream, Comcast, AT&T, etc)
     * company_name - The company name shown on the existing carrier's bill. 20 Characters max, use abbreviations.
     * account_number - The account number without spaces, dashes, dots, etc. They will be stripped upon submission.
     * authorized_user - The authorized name on the account.
     * authorized_phone_number - A contact number for the authorized user.
     * btn - The billing telephone number for the account. This is normally the 'main' phone number.
     * street_number - The numerical portion of the street address the existing carrier has on file. (ie. 290)
     * street_prefix - The optional street prefix. (Only N/S/W/E/NW/NE/SE/SW accepted)
     * street_name - The street name portion of the address. (i.e. Main Street)
     * street_suffix - The optional street suffix. (Only N/S/W/E/NW/NE/SE/SW accepted)
     * city - The city the existing carrier has on file.
     * state - The TWO character abbreviation for the state.
     * zip - The zip code for the existing bill (numerical only)
     *
     * [numbers] array should be an array of numbers to port. The following fields are required for each:
     *
     * number - The 10 digit phone number
     * type - Should be one of VFAX or VOICE
     * description - A description of the number (i.e. Acme Main Line, or Bob's VFAX Number)
     *
     * @param array $loa The LOA information to generate
     *
     * [loa]
     * email - The email address to send the LOA (or stage the LOA if not sending automatically)
     * send : bool : Send LOA automatically to customer for signing?
     *
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, array $subscriberData, array $numbers, array $loa)
    {
        return $this->send("pbx/{$pbx}/port_orders", 'post', [
            'subscriber_data' => $subscriberData,
            'numbers'         => $numbers,
            'loa'             => $loa
        ]);
    }

    /**
     * Get Port order Details, including lifecycle events and LOA signing status.
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("/pbx/{$pbx}/port_orders/{$uuid}")->order;
    }

    /**
     * Send or Re-Send an unsigned LOA.
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function sendLOA(string $pbx, string $uuid)
    {
        return $this->send("/pbx/{$pbx}/port_orders/{$uuid}/send");
    }

    /**
     * IMMEDIATELY cancel a port order. Note, if an FOC has already been obtained you are subject
     * to a $25 PER ORDER cancellation fee.
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function cancel(string $pbx, string $uuid)
    {
        return $this->send("/pbx/{$pbx}/port_orders/{$uuid}", 'delete');
    }


}