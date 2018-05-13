<?php
namespace EvolveAPI\Models;
use EvolveAPI\EVCore;

/**
 * Class Action
 * @package EvolveAPI\Models
 */
class Action extends EVCore
{

    /**
     * Action Constructor
     * @param string $environment
     */
    public function __construct(string $environment)
    {
        parent::__construct();
        $this->environment = $environment;
    }

    /**
     * Get a list of PBX Actions
     * @param string $pbx
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function all(string $pbx)
    {
        return $this->send("pbx/{$pbx}/actions")->actions;
    }

    /**
     * Get an action
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function find(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/actions/{$uuid}")->action;
    }

    /**
     * Create a new PBX Action
     * @param string $pbx UUID of the PBX
     * @param array $settings
     *  name : string : A name defining the action. (ex. Forward call to 404.xxx.xxxx)
     *  type : string : Type of: (see online documentation for more detail)
     *      FORWARD - Forward the call to a destination
     *      ALTERCALLERIDNAME - Change the caller ID Name (Can be used to identify callers from an auto attendant)
     *      FEATURECODE - Use Feature Code
     *      TOGGLEEXTSTATE - Toggle the state of a flow
     *      SETEXTINUSE - Set the state of a flow to IN USE
     *      SETEXTNOTINUSE - Set the state of a flow to NOT IN USE
     *      EMAILTO - Send an email
     *      CALLTHROUGH - Originate a call through
     *  settings : array : Settings based on the action type (see documentation)
     *
     *
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function create(string $pbx, array $settings)
    {
        return $this->send("pbx/{$pbx}/actions", 'POST', $settings);
    }

    /**
     * Update an Action - Same parameters as create
     * @param string $pbx
     * @param string $uuid
     * @param array $settings
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function update(string $pbx, string $uuid, array $settings)
    {
        return $this->send("pbx/{$pbx}/actions/{$uuid}", 'PUT', $settings);
    }

    /**
     * Remove an Action
     * @param string $pbx
     * @param string $uuid
     * @return mixed
     * @throws \EvolveAPI\EVException
     */
    public function delete(string $pbx, string $uuid)
    {
        return $this->send("pbx/{$pbx}/actions/{$uuid}", 'DELETE');
    }
}